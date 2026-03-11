<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$success = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id != $_SESSION['admin_id']) {
        $conn->query("DELETE FROM team_members WHERE id = $id");
        redirect('/maktoz/admin/team.php');
    } else {
        $error = 'You cannot delete your own account.';
    }
}

if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $conn->query("UPDATE team_members SET status = IF(status='active','inactive','active') WHERE id = $id");
    redirect('/maktoz/admin/team.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = clean($_POST['full_name'] ?? '');
    $username  = clean($_POST['username'] ?? '');
    $email     = clean($_POST['email'] ?? '');
    $phone     = clean($_POST['phone'] ?? '');
    $role      = clean($_POST['role'] ?? 'staff');
    $password  = $_POST['password'] ?? '';

    if (empty($full_name) || empty($username) || empty($email)) {
        $error = 'Full name, username and email are required.';
    } else {
        if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
            $id = (int)$_POST['edit_id'];
            if (!empty($password)) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE team_members SET full_name=?, username=?, email=?, phone=?, role=?, password=? WHERE id=?");
                $stmt->bind_param("ssssssi", $full_name, $username, $email, $phone, $role, $hashed, $id);
            } else {
                $stmt = $conn->prepare("UPDATE team_members SET full_name=?, username=?, email=?, phone=?, role=? WHERE id=?");
                $stmt->bind_param("sssssi", $full_name, $username, $email, $phone, $role, $id);
            }
        } else {
            if (empty($password)) {
                $error = 'Password is required for new members.';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO team_members (full_name, username, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $full_name, $username, $email, $phone, $role, $hashed);
            }
        }
        if (empty($error)) {
            if ($stmt->execute()) {
                $success = 'Team member saved successfully!';
            } else {
                $error = 'Username already exists or something went wrong.';
            }
            $stmt->close();
        }
    }
}

$edit_member = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM team_members WHERE id = $id");
    $edit_member = $result->fetch_assoc();
}

$members = $conn->query("SELECT * FROM team_members ORDER BY created_at DESC");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Team Members - Maktoz Admin</title>
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
                    <li><a href="/maktoz/admin/clients.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-users mr-3"></i>Clients</a></li>
                    <li><a href="/maktoz/admin/services.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-concierge-bell mr-3"></i>Services</a></li>
                    <li><a href="/maktoz/admin/billing.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-file-invoice-dollar mr-3"></i>Billing</a></li>
                    <li><a href="/maktoz/admin/reports.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-chart-bar mr-3"></i>Reports</a></li>
                    <li><a href="/maktoz/admin/team.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-user-friends mr-3"></i>Team</a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Team Members</h2>

            <?php if ($success): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-check-circle mr-2"></i><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6"><?php echo $edit_member ? 'Edit Member' : 'Add New Team Member'; ?></h3>
                <form method="POST" action="/maktoz/admin/team.php">
                    <?php if ($edit_member): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_member['id']; ?>" />
                    <?php endif; ?>
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="<?php echo $edit_member ? clean($edit_member['full_name']) : ''; ?>" placeholder="John Smith" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                            <input type="text" name="username" value="<?php echo $edit_member ? clean($edit_member['username']) : ''; ?>" placeholder="johnsmith" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="<?php echo $edit_member ? clean($edit_member['email']) : ''; ?>" placeholder="john@maktoz.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="<?php echo $edit_member ? clean($edit_member['phone']) : ''; ?>" placeholder="+880 1XXX-XXXXXX" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <select name="role" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="staff" <?php echo ($edit_member && $edit_member['role'] === 'staff') ? 'selected' : ''; ?>>Staff</option>
                                <option value="manager" <?php echo ($edit_member && $edit_member['role'] === 'manager') ? 'selected' : ''; ?>>Manager</option>
                                <option value="admin" <?php echo ($edit_member && $edit_member['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password <?php echo $edit_member ? '(leave blank to keep)' : '<span class="text-red-500">*</span>'; ?></label>
                            <div class="relative">
                                <input type="password" name="password" id="pw" placeholder="Enter password" class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" <?php echo $edit_member ? '' : 'required'; ?> />
                                <button type="button" onclick="togglePw()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="pwIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-save mr-2"></i><?php echo $edit_member ? 'Update Member' : 'Add Member'; ?>
                        </button>
                        <?php if ($edit_member): ?>
                            <a href="/maktoz/admin/team.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition"><i class="fas fa-times mr-2"></i>Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Members List -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">All Team Members</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-sm border-b">
                                <th class="pb-3">Name</th>
                                <th class="pb-3">Username</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Phone</th>
                                <th class="pb-3">Role</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($member = $members->fetch_assoc()): ?>
                            <tr class="text-sm">
                                <td class="py-3 font-semibold text-gray-900"><?php echo clean($member['full_name']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($member['username']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($member['email']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($member['phone']) ?: '-'; ?></td>
                                <td class="py-3">
                                    <?php
                                    $roleColors = ['admin' => 'bg-purple-100 text-purple-600', 'manager' => 'bg-blue-100 text-blue-600', 'staff' => 'bg-gray-100 text-gray-600'];
                                    $roleColor = $roleColors[$member['role']] ?? 'bg-gray-100 text-gray-600';
                                    ?>
                                    <span class="<?php echo $roleColor; ?> text-xs px-2 py-1 rounded-full capitalize"><?php echo $member['role']; ?></span>
                                </td>
                                <td class="py-3">
                                    <?php if ($member['status'] === 'active'): ?>
                                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Active</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3">
                                    <div class="flex space-x-3">
                                        <a href="/maktoz/admin/team.php?edit=<?php echo $member['id']; ?>" class="text-blue-600 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/maktoz/admin/team.php?toggle=<?php echo $member['id']; ?>" class="text-yellow-600 hover:text-yellow-700" title="Toggle Status"><i class="fas fa-power-off"></i></a>
                                        <?php if ($member['id'] != $_SESSION['admin_id']): ?>
                                        <a href="/maktoz/admin/team.php?delete=<?php echo $member['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this team member?')"><i class="fas fa-trash"></i></a>
                                        <?php endif; ?>
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

    <script>
        function togglePw() {
            const input = document.getElementById('pw');
            const icon = document.getElementById('pwIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
