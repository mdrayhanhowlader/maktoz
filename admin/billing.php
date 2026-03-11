<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$success = '';
$error = '';

if (isset($_GET['delete_invoice'])) {
    $id = (int)$_GET['delete_invoice'];
    $conn->query("DELETE FROM invoices WHERE id = $id");
    redirect('/maktoz/admin/billing.php');
}

if (isset($_GET['delete_payment'])) {
    $id = (int)$_GET['delete_payment'];
    $conn->query("DELETE FROM payments WHERE id = $id");
    redirect('/maktoz/admin/billing.php');
}

if (isset($_GET['mark_paid'])) {
    $id = (int)$_GET['mark_paid'];
    $conn->query("UPDATE invoices SET status = 'paid' WHERE id = $id");
    redirect('/maktoz/admin/billing.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'assign_service') {
        $client_id    = (int)$_POST['client_id'];
        $service_id   = (int)$_POST['service_id'];
        $start_date   = clean($_POST['start_date'] ?? '');
        $end_date     = !empty($_POST['end_date']) ? clean($_POST['end_date']) : null;
        $price        = floatval($_POST['price'] ?? 0);
        $billing_type = clean($_POST['billing_type'] ?? 'monthly');
        $notes        = clean($_POST['notes'] ?? '');

        if ($client_id && $service_id && $start_date && $price > 0) {
            $stmt = $conn->prepare("INSERT INTO client_services (client_id, service_id, start_date, end_date, price, billing_type, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissdss", $client_id, $service_id, $start_date, $end_date, $price, $billing_type, $notes);
            if ($stmt->execute()) {
                $success = 'Service assigned to client successfully!';
            } else {
                $error = 'Something went wrong.';
            }
            $stmt->close();
        } else {
            $error = 'Please fill all required fields.';
        }
    }

    if ($_POST['action'] === 'create_invoice') {
        $client_id         = (int)$_POST['client_id'];
        $client_service_id = !empty($_POST['client_service_id']) ? (int)$_POST['client_service_id'] : null;
        $amount            = floatval($_POST['amount'] ?? 0);
        $due_date          = clean($_POST['due_date'] ?? '');
        $notes             = clean($_POST['notes'] ?? '');
        $invoice_number    = 'INV-' . strtoupper(uniqid());

        if ($client_id && $amount > 0 && $due_date) {
            $stmt = $conn->prepare("INSERT INTO invoices (invoice_number, client_id, client_service_id, amount, due_date, notes) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siidss", $invoice_number, $client_id, $client_service_id, $amount, $due_date, $notes);
            if ($stmt->execute()) {
                $success = 'Invoice created! Invoice #: ' . $invoice_number;
            } else {
                $error = 'Something went wrong.';
            }
            $stmt->close();
        } else {
            $error = 'Please fill all required fields.';
        }
    }

    if ($_POST['action'] === 'record_payment') {
        $invoice_id     = (int)$_POST['invoice_id'];
        $client_id      = (int)$_POST['client_id'];
        $amount         = floatval($_POST['amount'] ?? 0);
        $payment_method = clean($_POST['payment_method'] ?? 'cash');
        $payment_date   = clean($_POST['payment_date'] ?? '');
        $notes          = clean($_POST['notes'] ?? '');

        if ($invoice_id && $client_id && $amount > 0 && $payment_date) {
            $stmt = $conn->prepare("INSERT INTO payments (invoice_id, client_id, amount, payment_method, payment_date, notes) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iidsss", $invoice_id, $client_id, $amount, $payment_method, $payment_date, $notes);
            if ($stmt->execute()) {
                $conn->query("UPDATE invoices SET status = 'paid' WHERE id = $invoice_id");
                $success = 'Payment recorded successfully!';
            } else {
                $error = 'Something went wrong.';
            }
            $stmt->close();
        } else {
            $error = 'Please fill all required fields.';
        }
    }
}

$clients         = $conn->query("SELECT id, name, company FROM clients ORDER BY name");
$services        = $conn->query("SELECT id, name, price, billing_type FROM services WHERE status = 'active' ORDER BY category");
$client_services = $conn->query("SELECT cs.*, c.name as client_name, s.name as service_name FROM client_services cs JOIN clients c ON cs.client_id = c.id JOIN services s ON cs.service_id = s.id ORDER BY cs.created_at DESC");
$invoices        = $conn->query("SELECT i.*, c.name as client_name FROM invoices i JOIN clients c ON i.client_id = c.id ORDER BY i.created_at DESC");
$payments        = $conn->query("SELECT p.*, c.name as client_name, i.invoice_number FROM payments p JOIN clients c ON p.client_id = c.id JOIN invoices i ON p.invoice_id = i.id ORDER BY p.created_at DESC LIMIT 20");
$unpaid_invoices = $conn->query("SELECT i.*, c.name as client_name FROM invoices i JOIN clients c ON i.client_id = c.id WHERE i.status = 'unpaid' OR i.status = 'overdue'");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
$total_revenue   = $conn->query("SELECT SUM(amount) as total FROM payments")->fetch_assoc()['total'] ?? 0;
$pending_amount  = $conn->query("SELECT SUM(amount) as total FROM invoices WHERE status = 'unpaid'")->fetch_assoc()['total'] ?? 0;
$active_services_count = $conn->query("SELECT COUNT(*) as c FROM client_services WHERE status='active'")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing - Maktoz Admin</title>
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
                    <li><a href="/maktoz/admin/billing.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-file-invoice-dollar mr-3"></i>Billing</a></li>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Billing & Payments</h2>

            <!-- Stats -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Revenue</p>
                            <p class="text-3xl font-bold text-green-600">৳<?php echo number_format($total_revenue, 2); ?></p>
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
                            <p class="text-3xl font-bold text-red-600">৳<?php echo number_format($pending_amount, 2); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Services</p>
                            <p class="text-3xl font-bold text-blue-600"><?php echo $active_services_count; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-blue-600 text-xl"></i>
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

            <!-- Tabs -->
            <div class="flex space-x-2 mb-6">
                <button onclick="showTab('assign')" id="tab-assign" class="px-6 py-3 rounded-lg font-semibold bg-blue-600 text-white transition">Assign Service</button>
                <button onclick="showTab('invoice')" id="tab-invoice" class="px-6 py-3 rounded-lg font-semibold bg-white text-gray-700 hover:bg-gray-50 transition">Create Invoice</button>
                <button onclick="showTab('payment')" id="tab-payment" class="px-6 py-3 rounded-lg font-semibold bg-white text-gray-700 hover:bg-gray-50 transition">Record Payment</button>
                <button onclick="showTab('history')" id="tab-history" class="px-6 py-3 rounded-lg font-semibold bg-white text-gray-700 hover:bg-gray-50 transition">History</button>
            </div>

            <!-- Assign Service -->
            <div id="content-assign" class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Assign Service to Client</h3>
                <form method="POST" action="/maktoz/admin/billing.php">
                    <input type="hidden" name="action" value="assign_service" />
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Client <span class="text-red-500">*</span></label>
                            <select name="client_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required>
                                <option value="">-- Select Client --</option>
                                <?php
                                $clients->data_seek(0);
                                while ($c = $clients->fetch_assoc()):
                                ?>
                                <option value="<?php echo $c['id']; ?>"><?php echo clean($c['name']); ?><?php echo $c['company'] ? ' - ' . clean($c['company']) : ''; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Service <span class="text-red-500">*</span></label>
                            <select name="service_id" id="serviceSelect" onchange="fillPrice()" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required>
                                <option value="">-- Select Service --</option>
                                <?php
                                $services->data_seek(0);
                                while ($s = $services->fetch_assoc()):
                                ?>
                                <option value="<?php echo $s['id']; ?>" data-price="<?php echo $s['price']; ?>" data-billing="<?php echo $s['billing_type']; ?>"><?php echo clean($s['name']); ?> - ৳<?php echo number_format($s['price'], 2); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Price (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="priceInput" placeholder="0.00" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Billing Type</label>
                            <select name="billing_type" id="billingInput" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="one_time">One Time</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date <span class="text-red-500">*</span></label>
                            <input type="date" name="start_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <input type="text" name="notes" placeholder="Additional notes..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        <i class="fas fa-plus mr-2"></i>Assign Service
                    </button>
                </form>
            </div>

            <!-- Create Invoice -->
            <div id="content-invoice" class="bg-white rounded-2xl shadow-sm p-6 mb-8 hidden">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Create Invoice</h3>
                <form method="POST" action="/maktoz/admin/billing.php">
                    <input type="hidden" name="action" value="create_invoice" />
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Client <span class="text-red-500">*</span></label>
                            <select name="client_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required>
                                <option value="">-- Select Client --</option>
                                <?php
                                $clients->data_seek(0);
                                while ($c = $clients->fetch_assoc()):
                                ?>
                                <option value="<?php echo $c['id']; ?>"><?php echo clean($c['name']); ?><?php echo $c['company'] ? ' - ' . clean($c['company']) : ''; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Amount (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="amount" placeholder="0.00" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Due Date <span class="text-red-500">*</span></label>
                            <input type="date" name="due_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <input type="text" name="notes" placeholder="Invoice notes..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        <i class="fas fa-file-invoice mr-2"></i>Create Invoice
                    </button>
                </form>

                <!-- Invoices List -->
                <div class="mt-8">
                    <h4 class="text-md font-bold text-gray-900 mb-4">All Invoices</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b">
                                    <th class="pb-3">Invoice #</th>
                                    <th class="pb-3">Client</th>
                                    <th class="pb-3">Amount</th>
                                    <th class="pb-3">Due Date</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php while ($inv = $invoices->fetch_assoc()): ?>
                                <tr>
                                    <td class="py-3 font-semibold text-blue-600"><?php echo clean($inv['invoice_number']); ?></td>
                                    <td class="py-3"><?php echo clean($inv['client_name']); ?></td>
                                    <td class="py-3 font-semibold text-green-600">৳<?php echo number_format($inv['amount'], 2); ?></td>
                                    <td class="py-3 text-gray-500"><?php echo date('M d, Y', strtotime($inv['due_date'])); ?></td>
                                    <td class="py-3">
                                        <?php
                                        $invColors = ['paid' => 'bg-green-100 text-green-600', 'unpaid' => 'bg-yellow-100 text-yellow-600', 'overdue' => 'bg-red-100 text-red-600', 'cancelled' => 'bg-gray-100 text-gray-600'];
                                        $ic = $invColors[$inv['status']] ?? 'bg-gray-100 text-gray-600';
                                        ?>
                                        <span class="<?php echo $ic; ?> text-xs px-2 py-1 rounded-full capitalize"><?php echo $inv['status']; ?></span>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex space-x-2">
                                            <?php if ($inv['status'] !== 'paid'): ?>
                                            <a href="/maktoz/admin/billing.php?mark_paid=<?php echo $inv['id']; ?>" class="text-green-600 hover:text-green-700" title="Mark Paid"><i class="fas fa-check"></i></a>
                                            <?php endif; ?>
                                            <a href="/maktoz/admin/billing.php?delete_invoice=<?php echo $inv['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this invoice?')"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Record Payment -->
            <div id="content-payment" class="bg-white rounded-2xl shadow-sm p-6 mb-8 hidden">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Record Payment</h3>
                <form method="POST" action="/maktoz/admin/billing.php">
                    <input type="hidden" name="action" value="record_payment" />
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Invoice <span class="text-red-500">*</span></label>
                            <select name="invoice_id" onchange="fillClientFromInvoice(this)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required>
                                <option value="">-- Select Invoice --</option>
                                <?php
                                $unpaid_invoices->data_seek(0);
                                while ($ui = $unpaid_invoices->fetch_assoc()):
                                ?>
                                <option value="<?php echo $ui['id']; ?>" data-client="<?php echo $ui['client_id']; ?>" data-amount="<?php echo $ui['amount']; ?>"><?php echo clean($ui['invoice_number']); ?> - <?php echo clean($ui['client_name']); ?> - ৳<?php echo number_format($ui['amount'], 2); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Client</label>
                            <input type="hidden" name="client_id" id="paymentClientId" />
                            <input type="text" id="paymentClientName" placeholder="Auto-filled from invoice" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50" readonly />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Amount (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="amount" id="paymentAmount" placeholder="0.00" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                            <select name="payment_method" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="bkash">bKash</option>
                                <option value="nagad">Nagad</option>
                                <option value="rocket">Rocket</option>
                                <option value="card">Card</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Date <span class="text-red-500">*</span></label>
                            <input type="date" name="payment_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <input type="text" name="notes" placeholder="Payment notes..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                        </div>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        <i class="fas fa-money-bill-wave mr-2"></i>Record Payment
                    </button>
                </form>
            </div>

            <!-- History -->
            <div id="content-history" class="bg-white rounded-2xl shadow-sm p-6 mb-8 hidden">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Client Services & Payment History</h3>

                <h4 class="font-semibold text-gray-700 mb-3">Active Client Services</h4>
                <div class="overflow-x-auto mb-8">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-3">Client</th>
                                <th class="pb-3">Service</th>
                                <th class="pb-3">Price</th>
                                <th class="pb-3">Billing</th>
                                <th class="pb-3">Start Date</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($cs = $client_services->fetch_assoc()): ?>
                            <tr>
                                <td class="py-3 font-semibold"><?php echo clean($cs['client_name']); ?></td>
                                <td class="py-3 text-gray-600"><?php echo clean($cs['service_name']); ?></td>
                                <td class="py-3 font-semibold text-green-600">৳<?php echo number_format($cs['price'], 2); ?></td>
                                <td class="py-3 text-gray-500 capitalize"><?php echo str_replace('_', ' ', $cs['billing_type']); ?></td>
                                <td class="py-3 text-gray-500"><?php echo date('M d, Y', strtotime($cs['start_date'])); ?></td>
                                <td class="py-3">
                                    <?php
                                    $csColors = ['active' => 'bg-green-100 text-green-600', 'paused' => 'bg-yellow-100 text-yellow-600', 'cancelled' => 'bg-red-100 text-red-600', 'completed' => 'bg-blue-100 text-blue-600'];
                                    $csc = $csColors[$cs['status']] ?? 'bg-gray-100 text-gray-600';
                                    ?>
                                    <span class="<?php echo $csc; ?> text-xs px-2 py-1 rounded-full capitalize"><?php echo $cs['status']; ?></span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <h4 class="font-semibold text-gray-700 mb-3">Recent Payments</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-3">Invoice #</th>
                                <th class="pb-3">Client</th>
                                <th class="pb-3">Amount</th>
                                <th class="pb-3">Method</th>
                                <th class="pb-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($pay = $payments->fetch_assoc()): ?>
                            <tr>
                                <td class="py-3 font-semibold text-blue-600"><?php echo clean($pay['invoice_number']); ?></td>
                                <td class="py-3"><?php echo clean($pay['client_name']); ?></td>
                                <td class="py-3 font-semibold text-green-600">৳<?php echo number_format($pay['amount'], 2); ?></td>
                                <td class="py-3 text-gray-500 capitalize"><?php echo str_replace('_', ' ', $pay['payment_method']); ?></td>
                                <td class="py-3 text-gray-500"><?php echo date('M d, Y', strtotime($pay['payment_date'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showTab(tab) {
            ['assign', 'invoice', 'payment', 'history'].forEach(t => {
                document.getElementById('content-' + t).classList.add('hidden');
                document.getElementById('tab-' + t).classList.remove('bg-blue-600', 'text-white');
                document.getElementById('tab-' + t).classList.add('bg-white', 'text-gray-700');
            });
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).classList.add('bg-blue-600', 'text-white');
            document.getElementById('tab-' + tab).classList.remove('bg-white', 'text-gray-700');
        }

        function fillPrice() {
            const select = document.getElementById('serviceSelect');
            const option = select.options[select.selectedIndex];
            document.getElementById('priceInput').value = option.dataset.price || '';
            const billing = option.dataset.billing || 'monthly';
            document.getElementById('billingInput').value = billing;
        }

        function fillClientFromInvoice(select) {
            const option = select.options[select.selectedIndex];
            document.getElementById('paymentClientId').value = option.dataset.client || '';
            document.getElementById('paymentClientName').value = option.text || '';
            document.getElementById('paymentAmount').value = option.dataset.amount || '';
        }
    </script>
</body>
</html>
