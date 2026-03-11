<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'Digital Marketing Agency';
require_once 'includes/header.php';
?>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-br from-blue-50 to-purple-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 lg:pr-12 mb-12 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Grow Your Business with
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">MAKTOZ</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        We help businesses scale through data-driven digital marketing strategies. From SEO to social media, we've got you covered.
                    </p>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="/maktoz/assets/images/undraw_report_k55w.png" alt="Digital Marketing" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">ROI Increased by 300%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Digital Marketing Services</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive digital marketing solutions tailored to your business needs</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fa-brands fa-facebook-f text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Meta Marketing Services</h3>
                    <p class="text-gray-600 mb-6">Facebook & Instagram Ads management to reach your target audience and drive conversions with precision targeting.</p>
                    <a href="/maktoz/service-meta.php" class="text-blue-600 font-semibold hover:text-blue-700 transition">Learn More →</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">WordPress Website Design</h3>
                    <p class="text-gray-600 mb-6">Professional WordPress website design & development services to create stunning, responsive websites for your business.</p>
                    <a href="/maktoz/service-wordpress.php" class="text-purple-600 font-semibold hover:text-purple-700 transition">Learn More →</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-server text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Domain & SSD Hosting</h3>
                    <p class="text-gray-600 mb-6">Reliable domain registration and high-performance SSD hosting services to keep your website fast and secure.</p>
                    <a href="/maktoz/service-hosting.php" class="text-pink-600 font-semibold hover:text-pink-700 transition">Learn More →</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">SEO Services</h3>
                    <p class="text-gray-600 mb-6">Boost your search rankings and drive organic traffic with our proven SEO optimization strategies and techniques.</p>
                    <a href="/maktoz/service-seo.php" class="text-green-600 font-semibold hover:text-green-700 transition">Learn More →</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">B2B Lead Generation</h3>
                    <p class="text-gray-600 mb-6">Generate high-quality B2B leads through targeted campaigns and strategic outreach to grow your business pipeline.</p>
                    <a href="/maktoz/service-lead-generation.php" class="text-orange-600 font-semibold hover:text-orange-700 transition">Learn More →</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition group">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-cogs text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Custom Web Applications</h3>
                    <p class="text-gray-600 mb-6">Custom web applications & automation solutions to streamline your business processes and improve efficiency.</p>
                    <a href="/maktoz/service-custom-web-automation.php" class="text-indigo-600 font-semibold hover:text-indigo-700 transition">Learn More →</a>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
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

    <!-- Testimonials -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h2>
                <p class="text-xl text-gray-600">Don't just take our word for it</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"Maktoz transformed our online presence. Our website traffic increased by 400% in just 6 months!"</p>
                    <div class="flex items-center">
                        <img src="https://placehold.co/50x50/4F46E5/FFFFFF?text=JS" alt="Client" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <div class="font-semibold text-gray-900">John Smith</div>
                            <div class="text-gray-500 text-sm">CEO, TechCorp</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"Professional, results-driven, and always available. They've become an essential part of our marketing team."</p>
                    <div class="flex items-center">
                        <img src="https://placehold.co/50x50/7C3AED/FFFFFF?text=MJ" alt="Client" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <div class="font-semibold text-gray-900">Maria Johnson</div>
                            <div class="text-gray-500 text-sm">Marketing Director, RetailPlus</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"ROI speaks for itself. We've seen a 250% increase in qualified leads since working with Maktoz."</p>
                    <div class="flex items-center">
                        <img src="https://placehold.co/50x50/EC4899/FFFFFF?text=DW" alt="Client" class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <div class="font-semibold text-gray-900">David Wilson</div>
                            <div class="text-gray-500 text-sm">Founder, StartupXYZ</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Ready to Grow Your Business?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Let's discuss how we can help you achieve your digital marketing goals. Get a free consultation today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/maktoz/contact.php" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Get Free Consultation</a>
                    <a href="/maktoz/blog/index.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition">View Our Blog</a>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
