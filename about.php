<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'About Us';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        We Are
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Maktoz</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-6 leading-relaxed">A results-driven digital marketing agency based in Dhaka, Bangladesh. We help businesses grow through innovative digital strategies, creative campaigns, and data-driven decisions.</p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">Founded with a passion for helping businesses succeed online, Maktoz has grown to become one of the most trusted digital marketing agencies in Bangladesh.</p>
                    <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition inline-block">Get In Touch</a>
                </div>
                <div class="lg:w-1/2">
                    <img src="https://placehold.co/600x400/4F46E5/FFFFFF?text=About+Maktoz" alt="About Maktoz" class="rounded-2xl shadow-2xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl text-white">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
                    <p class="text-blue-100 leading-relaxed">To empower businesses of all sizes with cutting-edge digital marketing solutions that drive real, measurable results. We believe every business deserves to thrive in the digital world.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-2xl">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h2>
                    <p class="text-gray-600 leading-relaxed">To become the leading digital marketing agency in Bangladesh, recognized for our innovative strategies, exceptional results, and commitment to client success.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Happy Clients</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Projects Completed</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">300%</div>
                    <div class="text-blue-100">Average ROI Increase</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-blue-100">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Core Values</h2>
                <p class="text-xl text-gray-600">What drives us every day</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Results-Driven</h3>
                    <p class="text-gray-600">Every campaign is designed with clear ROI targets and measurable outcomes.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-handshake text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparency</h3>
                    <p class="text-gray-600">We believe in open, honest communication and clear reporting at all times.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                    <p class="text-gray-600">We stay ahead of the curve with the latest digital marketing trends and tools.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Client First</h3>
                    <p class="text-gray-600">Your success is our success. We are committed to delivering exceptional service.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Ready to Work With Us?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Let's discuss how we can help you achieve your digital marketing goals.</p>
                <a href="/maktoz/contact.php" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition inline-block">Get Free Consultation</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
