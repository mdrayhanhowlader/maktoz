<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'Contact Us';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = clean($_POST['name'] ?? '');
    $email   = clean($_POST['email'] ?? '');
    $phone   = clean($_POST['phone'] ?? '');
    $service = clean($_POST['service'] ?? '');
    $message = clean($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $service, $message);
        if ($stmt->execute()) {
            $success = 'Thank you! Your message has been sent. We will get back to you soon.';
        } else {
            $error = 'Something went wrong. Please try again.';
        }
        $stmt->close();
    }
}

require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Get In Touch</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Have a project in mind? We'd love to hear from you. Send us a message and we'll get back to you as soon as possible.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 max-w-6xl mx-auto">

                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>

                    <?php if ($success): ?>
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                            <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/maktoz/contact.php">
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? clean($_POST['name']) : ''; ?>" placeholder="John Smith" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="<?php echo isset($_POST['email']) ? clean($_POST['email']) : ''; ?>" placeholder="john@example.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? clean($_POST['phone']) : ''; ?>" placeholder="+880 1XXX-XXXXXX" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Service Interested In</label>
                                <select name="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                    <option value="">Select a Service</option>
                                    <option value="Meta Marketing" <?php echo (isset($_POST['service']) && $_POST['service'] === 'Meta Marketing') ? 'selected' : ''; ?>>Meta Marketing Services</option>
                                    <option value="WordPress Development" <?php echo (isset($_POST['service']) && $_POST['service'] === 'WordPress Development') ? 'selected' : ''; ?>>WordPress Website Design</option>
                                    <option value="Domain & Hosting" <?php echo (isset($_POST['service']) && $_POST['service'] === 'Domain & Hosting') ? 'selected' : ''; ?>>Domain & SSD Hosting</option>
                                    <option value="SEO Services" <?php echo (isset($_POST['service']) && $_POST['service'] === 'SEO Services') ? 'selected' : ''; ?>>SEO Services</option>
                                    <option value="B2B Lead Generation" <?php echo (isset($_POST['service']) && $_POST['service'] === 'B2B Lead Generation') ? 'selected' : ''; ?>>B2B Lead Generation</option>
                                    <option value="Custom Web Applications" <?php echo (isset($_POST['service']) && $_POST['service'] === 'Custom Web Applications') ? 'selected' : ''; ?>>Custom Web Applications</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message <span class="text-red-500">*</span></label>
                            <textarea name="message" rows="5" placeholder="Tell us about your project..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none" required><?php echo isset($_POST['message']) ? clean($_POST['message']) : ''; ?></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-lg font-semibold text-lg hover:shadow-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
                    <div class="space-y-6 mb-10">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                                <a href="tel:+8801981040269" class="text-gray-600 hover:text-blue-600">+880 1981-040269</a>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                <a href="mailto:info@Maktoz.com" class="text-gray-600 hover:text-blue-600">info@Maktoz.com</a>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Address</h4>
                                <p class="text-gray-600">Shanti Nagar, Dhaka, Bangladesh</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex space-x-4 mb-10">
                        <a href="#" class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center hover:bg-blue-700 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center hover:bg-sky-600 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-12 h-12 bg-blue-700 text-white rounded-xl flex items-center justify-center hover:bg-blue-800 transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="w-12 h-12 bg-pink-600 text-white rounded-xl flex items-center justify-center hover:bg-pink-700 transition"><i class="fab fa-instagram"></i></a>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 rounded-2xl text-white">
                        <h3 class="text-xl font-bold mb-4">Working Hours</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-blue-100">Saturday - Thursday</span>
                                <span class="font-semibold">9:00 AM - 6:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-100">Friday</span>
                                <span class="font-semibold">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
