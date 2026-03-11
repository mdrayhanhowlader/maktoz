<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (isLoggedIn()) {
    redirect('/maktoz/admin/index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter username and password.';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            redirect('/maktoz/admin/index.php');
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - Maktoz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-lock text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Admin Login</h1>
            <p class="text-gray-500 mt-1">Maktoz Dashboard</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/maktoz/admin/login.php">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="username" placeholder="Enter username" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="password" name="password" id="password" placeholder="Enter password" class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="/maktoz/index.php" class="text-gray-500 hover:text-blue-600 text-sm transition">
                <i class="fas fa-arrow-left mr-1"></i>Back to Website
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
