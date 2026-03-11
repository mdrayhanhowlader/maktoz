<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$success = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM services WHERE id = $id");
    redirect('/maktoz/admin/services.php');
}

if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $conn->query("UPDATE services SET status = IF(status='active','inactive','active') WHERE id = $id");
    redirect('/maktoz/admin/services.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = clean($_POST['name'] ?? '');
    $category     = clean($_POST['category'] ?? '');
    $description  = clean($_POST['description'] ?? '');
    $price        = floatval($_POST['price'] ?? 0);
    $billing_type = clean($_POST['billing_type'] ?? 'monthly');

    if (empty($name) || empty($category) || $price <= 0) {
        $error = 'Name, category and price are required.';
    } else {
        if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
            $id = (int)$_POST['edit_id'];
            $stmt = $conn->prepare("UPDATE services SET name=?, category=?, description=?, price=?, billing_type=? WHERE id=?");
            $stmt->bind_param("sssdsi", $name, $category, $description, $price, $billing_type, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO services (name, category, description, price, billing_type) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssds", $name, $category, $description, $price, $billing_type);
        }
        if ($stmt->execute()) {
            $success = 'Service saved successfully!';
        } else {
            $error = 'Something went wrong. Please try again.';
        }
        $stmt->close();
    }
}

$edit_service = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM services WHERE id = $id");
    $edit_service = $result->fetch_assoc();
}

$services = $conn->query("SELECT * FROM services ORDER BY category, billing_type");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];

$categories = [
    'Meta Marketing',
    'WordPress Development',
    'Domain & Hosting',
    'SEO Services',
    'B2B Lead Generation',
    'Custom Web Applications'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services - Maktoz Admin</title>
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
                    <li><a href="/maktoz/admin/services.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-concierge-bell mr-3"></i>Services</a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Services</h2>

            <?php if ($success): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-check-circle mr-2"></i><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6"><?php echo $edit_service ? 'Edit Service' : 'Add New Service'; ?></h3>
                <form method="POST" action="/maktoz/admin/services.php">
                    <?php if ($edit_service): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_service['id']; ?>" />
                    <?php endif; ?>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Service Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="<?php echo $edit_service ? clean($edit_service['name']) : ''; ?>" placeholder="e.g. Meta Ads Growth Package" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                            <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required>
                                <option value="">-- Select Category --</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat; ?>" <?php echo ($edit_service && $edit_service['category'] === $cat) ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Price (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" value="<?php echo $edit_service ? $edit_service['price'] : ''; ?>" placeholder="0.00" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Billing Type</label>
                            <select name="billing_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="one_time" <?php echo ($edit_service && $edit_service['billing_type'] === 'one_time') ? 'selected' : ''; ?>>One Time</option>
                                <option value="weekly" <?php echo ($edit_service && $edit_service['billing_type'] === 'weekly') ? 'selected' : ''; ?>>Weekly</option>
                                <option value="monthly" <?php echo ($edit_service && $edit_service['billing_type'] === 'monthly') ? 'selected' : ''; ?>>Monthly</option>
                                <option value="yearly" <?php echo ($edit_service && $edit_service['billing_type'] === 'yearly') ? 'selected' : ''; ?>>Yearly</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="3" placeholder="Service description..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none"><?php echo $edit_service ? clean($edit_service['description']) : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-save mr-2"></i><?php echo $edit_service ? 'Update Service' : 'Add Service'; ?>
                        </button>
                        <?php if ($edit_service): ?>
                            <a href="/maktoz/admin/services.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition"><i class="fas fa-times mr-2"></i>Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Services List -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">All Services</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-sm border-b">
                                <th class="pb-3">#</th>
                                <th class="pb-3">Service Name</th>
                                <th class="pb-3">Category</th>
                                <th class="pb-3">Price</th>
                                <th class="pb-3">Billing</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($service = $services->fetch_assoc()): ?>
                            <tr class="text-sm">
                                <td class="py-3 text-gray-500"><?php echo $service['id']; ?></td>
                                <td class="py-3 font-semibold text-gray-900"><?php echo clean($service['name']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($service['category']); ?></td>
                                <td class="py-3 font-semibold text-green-600">৳<?php echo number_format($service['price'], 2); ?></td>
                                <td class="py-3">
                                    <?php
                                    $btColors = ['one_time' => 'bg-purple-100 text-purple-600', 'weekly' => 'bg-blue-100 text-blue-600', 'monthly' => 'bg-green-100 text-green-600', 'yearly' => 'bg-orange-100 text-orange-600'];
                                    $btLabels = ['one_time' => 'One Time', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly'];
                                    $btc = $btColors[$service['billing_type']] ?? 'bg-gray-100 text-gray-600';
                                    $btl = $btLabels[$service['billing_type']] ?? $service['billing_type'];
                                    ?>
                                    <span class="<?php echo $btc; ?> text-xs px-2 py-1 rounded-full"><?php echo $btl; ?></span>
                                </td>
                                <td class="py-3">
                                    <?php if ($service['status'] === 'active'): ?>
                                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Active</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3">
                                    <div class="flex space-x-3">
                                        <a href="/maktoz/admin/services.php?edit=<?php echo $service['id']; ?>" class="text-blue-600 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/maktoz/admin/services.php?toggle=<?php echo $service['id']; ?>" class="text-yellow-600 hover:text-yellow-700" title="Toggle Status"><i class="fas fa-power-off"></i></a>
                                        <a href="/maktoz/admin/services.php?delete=<?php echo $service['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this service?')"><i class="fas fa-trash"></i></a>
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
