<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$total_contacts   = $conn->query("SELECT COUNT(*) as count FROM contacts")->fetch_assoc()['count'];
$unread_contacts  = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
$total_posts      = $conn->query("SELECT COUNT(*) as count FROM blog_posts")->fetch_assoc()['count'];
$published_posts  = $conn->query("SELECT COUNT(*) as count FROM blog_posts WHERE status = 'published'")->fetch_assoc()['count'];
$total_clients    = $conn->query("SELECT COUNT(*) as count FROM clients")->fetch_assoc()['count'];
$active_clients   = $conn->query("SELECT COUNT(*) as count FROM clients WHERE status = 'active'")->fetch_assoc()['count'];
$total_revenue    = $conn->query("SELECT SUM(amount) as total FROM payments")->fetch_assoc()['total'] ?? 0;
$pending_amount   = $conn->query("SELECT SUM(amount) as total FROM invoices WHERE status = 'unpaid'")->fetch_assoc()['total'] ?? 0;
$total_team       = $conn->query("SELECT COUNT(*) as count FROM team_members WHERE status = 'active'")->fetch_assoc()['count'];
$active_services  = $conn->query("SELECT COUNT(*) as count FROM client_services WHERE status = 'active'")->fetch_assoc()['count'];

$recent_contacts = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");
$recent_payments = $conn->query("SELECT p.*, c.name as client_name FROM payments p JOIN clients c ON p.client_id = c.id ORDER BY p.created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Maktoz</title>
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
                    <li><a href="/maktoz/admin/index.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                    <li><a href="/maktoz/admin/contacts.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-envelope mr-3"></i>Contacts<?php if ($unread_contacts > 0): ?><span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?php echo $unread_contacts; ?></span><?php endif; ?></a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Dashboard Overview</h2>

            <!-- Stats Row 1 -->
            <div class="grid md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Revenue</p>
                            <p class="text-2xl font-bold text-green-600">৳<?php echo number_format($total_revenue, 0); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Pending Amount</p>
                            <p class="text-2xl font-bold text-red-600">৳<?php echo number_format($pending_amount, 0); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Clients</p>
                            <p class="text-2xl font-bold text-blue-600"><?php echo $total_clients; ?></p>
                            <p class="text-xs text-gray-400"><?php echo $active_clients; ?> active</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Services</p>
                            <p class="text-2xl font-bold text-purple-600"><?php echo $active_services; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row 2 -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Contacts</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $total_contacts; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-envelope text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Unread Messages</p>
                            <p class="text-2xl font-bold text-red-600"><?php echo $unread_contacts; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-bell text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Blog Posts</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $total_posts; ?></p>
                            <p class="text-xs text-gray-400"><?php echo $published_posts; ?> published</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-blog text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Team Members</p>
                            <p class="text-2xl font-bold text-indigo-600"><?php echo $total_team; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-friends text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">

                <!-- Recent Contacts -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Recent Messages</h3>
                        <a href="/maktoz/admin/contacts.php" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All →</a>
                    </div>
                    <div class="space-y-3">
                        <?php while ($contact = $recent_contacts->fetch_assoc()): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm"><?php echo clean($contact['name']); ?></p>
                                <p class="text-xs text-gray-500"><?php echo clean($contact['service']) ?: 'General Inquiry'; ?></p>
                            </div>
                            <div class="text-right">
                                <?php if ($contact['is_read'] == 0): ?>
                                    <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Unread</span>
                                <?php else: ?>
                                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Read</span>
                                <?php endif; ?>
                                <p class="text-xs text-gray-400 mt-1"><?php echo date('M d', strtotime($contact['created_at'])); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php if ($total_contacts == 0): ?>
                            <p class="text-gray-400 text-center py-4">No messages yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Recent Payments</h3>
                        <a href="/maktoz/admin/billing.php" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All →</a>
                    </div>
                    <div class="space-y-3">
                        <?php while ($pay = $recent_payments->fetch_assoc()): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm"><?php echo clean($pay['client_name']); ?></p>
                                <p class="text-xs text-gray-500"><?php echo ucfirst(str_replace('_', ' ', $pay['payment_method'])); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600">৳<?php echo number_format($pay['amount'], 0); ?></p>
                                <p class="text-xs text-gray-400"><?php echo date('M d', strtotime($pay['payment_date'])); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php if ($total_revenue == 0): ?>
                            <p class="text-gray-400 text-center py-4">No payments yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
