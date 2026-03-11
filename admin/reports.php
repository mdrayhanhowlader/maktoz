<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];

$total_revenue    = $conn->query("SELECT SUM(amount) as total FROM payments")->fetch_assoc()['total'] ?? 0;
$total_clients    = $conn->query("SELECT COUNT(*) as count FROM clients")->fetch_assoc()['count'];
$active_clients   = $conn->query("SELECT COUNT(*) as count FROM clients WHERE status = 'active'")->fetch_assoc()['count'];
$pending_amount   = $conn->query("SELECT SUM(amount) as total FROM invoices WHERE status = 'unpaid'")->fetch_assoc()['total'] ?? 0;
$total_invoices   = $conn->query("SELECT COUNT(*) as count FROM invoices")->fetch_assoc()['count'];
$paid_invoices    = $conn->query("SELECT COUNT(*) as count FROM invoices WHERE status = 'paid'")->fetch_assoc()['count'];
$unpaid_invoices  = $conn->query("SELECT COUNT(*) as count FROM invoices WHERE status = 'unpaid'")->fetch_assoc()['count'];
$total_services   = $conn->query("SELECT COUNT(*) as count FROM client_services WHERE status = 'active'")->fetch_assoc()['count'];
$total_team       = $conn->query("SELECT COUNT(*) as count FROM team_members WHERE status = 'active'")->fetch_assoc()['count'];
$total_contacts   = $conn->query("SELECT COUNT(*) as count FROM contacts")->fetch_assoc()['count'];

$monthly_revenue = $conn->query("
    SELECT DATE_FORMAT(payment_date, '%b %Y') as month, SUM(amount) as total
    FROM payments
    GROUP BY DATE_FORMAT(payment_date, '%Y-%m')
    ORDER BY payment_date DESC
    LIMIT 6
");

$service_revenue = $conn->query("
    SELECT s.category, SUM(p.amount) as total
    FROM payments p
    JOIN invoices i ON p.invoice_id = i.id
    JOIN client_services cs ON i.client_service_id = cs.id
    JOIN services s ON cs.service_id = s.id
    GROUP BY s.category
    ORDER BY total DESC
");

$top_clients = $conn->query("
    SELECT c.name, c.company, SUM(p.amount) as total_paid
    FROM payments p
    JOIN clients c ON p.client_id = c.id
    GROUP BY p.client_id
    ORDER BY total_paid DESC
    LIMIT 5
");

$recent_payments = $conn->query("
    SELECT p.*, c.name as client_name, i.invoice_number
    FROM payments p
    JOIN clients c ON p.client_id = c.id
    JOIN invoices i ON p.invoice_id = i.id
    ORDER BY p.created_at DESC
    LIMIT 10
");

$service_breakdown = $conn->query("
    SELECT s.category, COUNT(cs.id) as total, SUM(cs.price) as revenue
    FROM client_services cs
    JOIN services s ON cs.service_id = s.id
    WHERE cs.status = 'active'
    GROUP BY s.category
    ORDER BY total DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reports - Maktoz Admin</title>
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
                    <li><a href="/maktoz/admin/reports.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-chart-bar mr-3"></i>Reports</a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Business Reports</h2>

            <!-- Main Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
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
                            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
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
                            <p class="text-2xl font-bold text-purple-600"><?php echo $total_services; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Invoices</p>
                            <p class="text-2xl font-bold text-gray-900"><?php echo $total_invoices; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-invoice text-gray-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Paid Invoices</p>
                            <p class="text-2xl font-bold text-green-600"><?php echo $paid_invoices; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Unpaid Invoices</p>
                            <p class="text-2xl font-bold text-yellow-600"><?php echo $unpaid_invoices; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
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

            <div class="grid lg:grid-cols-2 gap-8 mb-8">

                <!-- Monthly Revenue -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Monthly Revenue</h3>
                    <div class="space-y-4">
                        <?php
                        $monthly_data = [];
                        while ($mr = $monthly_revenue->fetch_assoc()) {
                            $monthly_data[] = $mr;
                        }
                        $max = max(array_column($monthly_data, 'total') ?: [1]);
                        foreach ($monthly_data as $mr):
                            $width = ($mr['total'] / $max) * 100;
                        ?>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600"><?php echo $mr['month']; ?></span>
                                <span class="font-semibold text-green-600">৳<?php echo number_format($mr['total'], 0); ?></span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3">
                                <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full" style="width: <?php echo $width; ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if (empty($monthly_data)): ?>
                            <p class="text-gray-400 text-center py-8">No payment data yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Service Breakdown -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Active Services by Category</h3>
                    <div class="space-y-4">
                        <?php
                        $categoryColors = [
                            'Meta Marketing'          => 'from-blue-500 to-blue-600',
                            'WordPress Development'   => 'from-purple-500 to-purple-600',
                            'Domain & Hosting'        => 'from-green-500 to-green-600',
                            'SEO Services'            => 'from-yellow-500 to-yellow-600',
                            'B2B Lead Generation'     => 'from-orange-500 to-orange-600',
                            'Custom Web Applications' => 'from-indigo-500 to-indigo-600',
                        ];
                        $sb_data = [];
                        while ($sb = $service_breakdown->fetch_assoc()) {
                            $sb_data[] = $sb;
                        }
                        $max_sb = max(array_column($sb_data, 'total') ?: [1]);
                        foreach ($sb_data as $sb):
                            $width = ($sb['total'] / $max_sb) * 100;
                            $color = $categoryColors[$sb['category']] ?? 'from-gray-500 to-gray-600';
                        ?>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600"><?php echo $sb['category']; ?></span>
                                <span class="font-semibold text-blue-600"><?php echo $sb['total']; ?> clients</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3">
                                <div class="bg-gradient-to-r <?php echo $color; ?> h-3 rounded-full" style="width: <?php echo $width; ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if (empty($sb_data)): ?>
                            <p class="text-gray-400 text-center py-8">No active services yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">

                <!-- Top Clients -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Top Clients by Revenue</h3>
                    <div class="space-y-4">
                        <?php
                        $rank = 1;
                        $rankColors = ['bg-yellow-400', 'bg-gray-300', 'bg-orange-400', 'bg-blue-200', 'bg-blue-100'];
                        while ($tc = $top_clients->fetch_assoc()):
                            $rc = $rankColors[$rank - 1] ?? 'bg-gray-100';
                        ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 <?php echo $rc; ?> rounded-full flex items-center justify-center font-bold text-sm mr-3"><?php echo $rank; ?></div>
                                <div>
                                    <p class="font-semibold text-gray-900"><?php echo clean($tc['name']); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo clean($tc['company']) ?: 'Individual'; ?></p>
                                </div>
                            </div>
                            <span class="font-bold text-green-600">৳<?php echo number_format($tc['total_paid'], 0); ?></span>
                        </div>
                        <?php $rank++; endwhile; ?>
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Recent Payments</h3>
                    <div class="space-y-3">
                        <?php while ($rp = $recent_payments->fetch_assoc()): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm"><?php echo clean($rp['client_name']); ?></p>
                                <p class="text-xs text-gray-500"><?php echo clean($rp['invoice_number']); ?> • <?php echo ucfirst(str_replace('_', ' ', $rp['payment_method'])); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600">৳<?php echo number_format($rp['amount'], 0); ?></p>
                                <p class="text-xs text-gray-400"><?php echo date('M d, Y', strtotime($rp['payment_date'])); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
