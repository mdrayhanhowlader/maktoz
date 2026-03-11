<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$success = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM clients WHERE id = $id");
    redirect('/maktoz/admin/clients.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = clean($_POST['name'] ?? '');
    $email       = clean($_POST['email'] ?? '');
    $phone       = clean($_POST['phone'] ?? '');
    $company     = clean($_POST['company'] ?? '');
    $address     = clean($_POST['address'] ?? '');
    $status      = clean($_POST['status'] ?? 'pending');
    $assigned_to = !empty($_POST['assigned_to']) ? (int)$_POST['assigned_to'] : null;
    $notes       = clean($_POST['notes'] ?? '');

    if (empty($name)) {
        $error = 'Client name is required.';
    } else {
        if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
            $id = (int)$_POST['edit_id'];
            $stmt = $conn->prepare("UPDATE clients SET name=?, email=?, phone=?, company=?, address=?, status=?, assigned_to=?, notes=? WHERE id=?");
            $stmt->bind_param("ssssssssi", $name, $email, $phone, $company, $address, $status, $assigned_to, $notes, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO clients (name, email, phone, company, address, status, assigned_to, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $email, $phone, $company, $address, $status, $assigned_to, $notes);
        }
        if ($stmt->execute()) {
            $success = 'Client saved successfully!';
        } else {
            $error = 'Something went wrong. Please try again.';
        }
        $stmt->close();
    }
}

$edit_client = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM clients WHERE id = $id");
    $edit_client = $result->fetch_assoc();
}

$clients = $conn->query("SELECT c.*, t.full_name as assigned_name FROM clients c LEFT JOIN team_members t ON c.assigned_to = t.id ORDER BY c.created_at DESC");
$team_members = $conn->query("SELECT id, full_name FROM team_members WHERE status = 'active'");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
$total_clients = $conn->query("SELECT COUNT(*) as count FROM clients")->fetch_assoc()['count'];
$active_clients = $conn->query("SELECT COUNT(*) as count FROM clients WHERE status = 'active'")->fetch_assoc()['count'];
$pending_clients = $conn->query("SELECT COUNT(*) as count FROM clients WHERE status = 'pending'")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients - Maktoz Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col fixed h-full overflow-y-auto">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-xl font-bold">Maktoz Admin</h1>
                <p class="text-gray-400 text-sm mt-1">Welcome, <?php echo $_SESSION['admin_username']; ?></p>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li><a href="/maktoz/admin/index.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                    <li><a href="/maktoz/admin/contacts.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-envelope mr-3"></i>Contacts<?php if ($unread_contacts > 0): ?><span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?php echo $unread_contacts; ?></span><?php endif; ?></a></li>
                    <li><a href="/maktoz/admin/clients.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-users mr-3"></i>Clients</a></li>
                    <li><a href="/maktoz/admin/services.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-concierge-bell mr-3"></i>Services</a></li>
                    <li><a href="/maktoz/admin/billing.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-file-invoice-dollar mr-3"></i>Billing</a></li>
                    <li><a href="/maktoz/admin/reports.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-chart-bar mr-3"></i>Reports</a></li>
                    <li><a href="/maktoz/admin/team.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-user-friends mr-3"></i>Team</a></li>
                    <li><a href="/maktoz/admin/blog.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-blog mr-3"></i>Blog Posts</a></li>
                    <li class="mt-4 border-t border-gray-700 pt-4">
                        <a href="/maktoz/index.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-globe mr-3"></i>View Website</a>
                    </li>
                    <li><a href="/maktoz/admin/logout.php" class="flex items-center px-4 py-3 rounded-lg text-red-400 hover:bg-gray-700 transition"><i class="fas fa-sign-out-alt mr-3"></i>Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Clients</h2>

            <!-- Stats -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Clients</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo $total_clients; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Clients</p>
                            <p class="text-3xl font-bold text-green-600"><?php echo $active_clients; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Pending Clients</p>
                            <p class="text-3xl font-bold text-yellow-600"><?php echo $pending_clients; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($success): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-check-circle mr-2"></i><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6"><?php echo $edit_client ? 'Edit Client' : 'Add New Client'; ?></h3>
                <form method="POST" action="/maktoz/admin/clients.php">
                    <?php if ($edit_client): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_client['id']; ?>" />
                    <?php endif; ?>
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Client Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="<?php echo $edit_client ? clean($edit_client['name']) : ''; ?>" placeholder="John Smith" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="<?php echo $edit_client ? clean($edit_client['email']) : ''; ?>" placeholder="john@company.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="<?php echo $edit_client ? clean($edit_client['phone']) : ''; ?>" placeholder="+880 1XXX-XXXXXX" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Company</label>
                            <input type="text" name="company" value="<?php echo $edit_client ? clean($edit_client['company']) : ''; ?>" placeholder="Company Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="pending" <?php echo ($edit_client && $edit_client['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="active" <?php echo ($edit_client && $edit_client['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo ($edit_client && $edit_client['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                <option value="completed" <?php echo ($edit_client && $edit_client['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Assign To</label>
                            <select name="assigned_to" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="">-- Select Team Member --</option>
                                <?php while ($member = $team_members->fetch_assoc()): ?>
                                <option value="<?php echo $member['id']; ?>" <?php echo ($edit_client && $edit_client['assigned_to'] == $member['id']) ? 'selected' : ''; ?>><?php echo clean($member['full_name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <input type="text" name="address" value="<?php echo $edit_client ? clean($edit_client['address']) : ''; ?>" placeholder="Client address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <textarea name="notes" rows="3" placeholder="Additional notes about the client..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none"><?php echo $edit_client ? clean($edit_client['notes']) : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-save mr-2"></i><?php echo $edit_client ? 'Update Client' : 'Add Client'; ?>
                        </button>
                        <?php if ($edit_client): ?>
                            <a href="/maktoz/admin/clients.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition"><i class="fas fa-times mr-2"></i>Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Clients List -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">All Clients</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-sm border-b">
                                <th class="pb-3">#</th>
                                <th class="pb-3">Name</th>
                                <th class="pb-3">Company</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Phone</th>
                                <th class="pb-3">Assigned To</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($client = $clients->fetch_assoc()): ?>
                            <tr class="text-sm">
                                <td class="py-3 text-gray-500"><?php echo $client['id']; ?></td>
                                <td class="py-3 font-semibold text-gray-900"><?php echo clean($client['name']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($client['company']) ?: '-'; ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($client['email']) ?: '-'; ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($client['phone']) ?: '-'; ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($client['assigned_name']) ?: '-'; ?></td>
                                <td class="py-3">
                                    <?php
                                    $statusColors = [
                                        'active'    => 'bg-green-100 text-green-600',
                                        'pending'   => 'bg-yellow-100 text-yellow-600',
                                        'inactive'  => 'bg-red-100 text-red-600',
                                        'completed' => 'bg-blue-100 text-blue-600',
                                    ];
                                    $sc = $statusColors[$client['status']] ?? 'bg-gray-100 text-gray-600';
                                    ?>
                                    <span class="<?php echo $sc; ?> text-xs px-2 py-1 rounded-full capitalize"><?php echo $client['status']; ?></span>
                                </td>
                                <td class="py-3">
                                    <div class="flex space-x-3">
                                        <a href="/maktoz/admin/clients.php?edit=<?php echo $client['id']; ?>" class="text-blue-600 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/maktoz/admin/billing.php?client_id=<?php echo $client['id']; ?>" class="text-green-600 hover:text-green-700" title="Billing"><i class="fas fa-file-invoice-dollar"></i></a>
                                        <a href="/maktoz/admin/clients.php?delete=<?php echo $client['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this client?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
