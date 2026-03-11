<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM contacts WHERE id = $id");
    redirect('/maktoz/admin/contacts.php');
}

if (isset($_GET['read'])) {
    $id = (int)$_GET['read'];
    $conn->query("UPDATE contacts SET is_read = 1 WHERE id = $id");
    redirect('/maktoz/admin/contacts.php');
}

$contacts = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Messages - Maktoz Admin</title>
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
                    <li><a href="/maktoz/admin/contacts.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-envelope mr-3"></i>Contacts<?php if ($unread_contacts > 0): ?><span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?php echo $unread_contacts; ?></span><?php endif; ?></a></li>
                    <li><a href="/maktoz/admin/clients.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-users mr-3"></i>Clients</a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Contact Messages</h2>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-sm border-b">
                                <th class="pb-3">#</th>
                                <th class="pb-3">Name</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Phone</th>
                                <th class="pb-3">Service</th>
                                <th class="pb-3">Message</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($contact = $contacts->fetch_assoc()): ?>
                            <tr class="text-sm <?php echo $contact['is_read'] == 0 ? 'bg-blue-50' : ''; ?>">
                                <td class="py-3 text-gray-500"><?php echo $contact['id']; ?></td>
                                <td class="py-3 font-semibold text-gray-900"><?php echo clean($contact['name']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($contact['email']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($contact['phone']) ?: '-'; ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($contact['service']) ?: '-'; ?></td>
                                <td class="py-3 text-gray-600 max-w-xs truncate"><?php echo clean($contact['message']); ?></td>
                                <td class="py-3 text-gray-500"><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></td>
                                <td class="py-3">
                                    <?php if ($contact['is_read'] == 0): ?>
                                        <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Unread</span>
                                    <?php else: ?>
                                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Read</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3">
                                    <div class="flex space-x-2">
                                        <?php if ($contact['is_read'] == 0): ?>
                                        <a href="/maktoz/admin/contacts.php?read=<?php echo $contact['id']; ?>" class="text-blue-600 hover:text-blue-700" title="Mark as Read"><i class="fas fa-check"></i></a>
                                        <?php endif; ?>
                                        <a href="mailto:<?php echo clean($contact['email']); ?>" class="text-green-600 hover:text-green-700" title="Reply"><i class="fas fa-reply"></i></a>
                                        <a href="/maktoz/admin/contacts.php?delete=<?php echo $contact['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i></a>
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
