<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'Domain & SSD Hosting Services';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">Domain & Hosting</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="pb-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 lg:pr-12 mb-12 lg:mb-0">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-server text-white text-2xl"></i>
                        </div>
                        <span class="text-green-600 font-semibold text-lg">DOMAIN & HOSTING</span>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Reliable Hosting &
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Domain Solutions</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">Reliable, fast & secure hosting paired with hassle-free domain management for your online success.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition text-center">Secure Your Domain Now</a>
                        <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold hover:border-blue-600 hover:text-blue-600 transition">Check Domain Availability</button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="https://placehold.co/600x400/10B981/FFFF?text=Domain+%26+Hosting" alt="Domain & Hosting" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">99.9% Uptime Guaranteed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">📦 Our Service Includes</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Complete domain and hosting solutions for your online presence</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-globe text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Domain Registration</h3>
                    <p class="text-gray-600">.com, .net, .org & more domain extensions available</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Free WHOIS Privacy Protection</h3>
                    <p class="text-gray-600">Keep your personal information private and secure</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-hdd text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">SSD Hosting for Lightning Speed</h3>
                    <p class="text-gray-600">Ultra-fast SSD storage for optimal website performance</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-lock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Free SSL Certificate & Daily Backups</h3>
                    <p class="text-gray-600">Secure connections and automatic daily data backups</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">99.9% Uptime & cPanel Access</h3>
                    <p class="text-gray-600">Reliable hosting with easy-to-use control panel</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fab fa-wordpress text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">One-Click WordPress Installation</h3>
                    <p class="text-gray-600">Quick and easy WordPress setup with just one click</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Domain & Hosting Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect hosting solution for your website</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">1️⃣ Starter Hosting Package</h3>
                        <p class="text-gray-600 mb-4">For Basic Website</p>
                        <div class="text-3xl font-bold text-green-600 mb-2">৳3,500 / year</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">1 .COM Domain (Free for 1st Year)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">1 GB SSD Hosting</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Free SSL Certificate</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">1 Business Email</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">cPanel Access</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">99.9% Uptime</span></div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-green-700"><strong>Ideal For:</strong> Personal Blog, Portfolio, Small Business</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">Get Started</a>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl shadow-xl text-white relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">2️⃣ Business Hosting Package</h3>
                        <p class="text-blue-100 mb-4">For Professional Website</p>
                        <div class="text-3xl font-bold mb-2">৳6,500 / year</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">1 .COM Domain (Free for 1st Year)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">5 GB SSD Hosting</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Free SSL + Daily Backup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">5 Business Emails</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced Security & Speed Optimization</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">24/7 Support</span></div>
                    </div>
                    <div class="bg-white bg-opacity-10 p-4 rounded-lg mb-6">
                        <p class="text-sm text-blue-100"><strong>Ideal For:</strong> Agency, Startup, Medium Business</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-white text-blue-600 py-3 rounded-lg font-semibold hover:shadow-lg transition text-center">Get Started</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-bag text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">3️⃣ E-commerce Hosting Package</h3>
                        <p class="text-gray-600 mb-4">For Online Shop</p>
                        <div class="text-3xl font-bold text-purple-600 mb-2">৳12,500 / year</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">1 .COM Domain (Free for 1st Year)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">15 GB SSD Hosting + High Bandwidth</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Free SSL + Premium Security</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Unlimited Business Emails</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">WooCommerce Ready Setup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Priority Support & Maintenance</span></div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-purple-700"><strong>Ideal For:</strong> Online Shop & High Traffic Website</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">Get Started</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">📞 Ready to Launch?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Secure your domain & hosting with a FREE setup session and get your website online today!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Secure Your Domain Now</a>
                <a href="/maktoz/contact.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition">Check Domain Availability</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
