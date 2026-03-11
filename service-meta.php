<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'Meta Marketing Services';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">Meta Marketing Services</li>
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
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fa-brands fa-facebook-f text-white text-2xl"></i>
                        </div>
                        <span class="text-blue-600 font-semibold text-lg">META MARKETING SERVICES</span>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Facebook & Instagram Ads That
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Drive Results</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">Reach the right audience, increase sales & build your brand with data-driven Meta Ads that deliver measurable ROI.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition text-center">Book FREE Consultation</a>
                        <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold hover:border-blue-600 hover:text-blue-600 transition">View Case Studies</button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="https://placehold.co/600x400/4F46E5/FFFF?text=Meta+Ads+Dashboard" alt="Meta Ads Dashboard" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">ROAS: 4.5x Average</span>
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
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive Meta advertising solutions designed to maximize your ROI</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Audience Research & Targeting</h3>
                    <p class="text-gray-600">Precise audience identification and targeting to reach your ideal customers</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-crosshairs text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Pixel / CAPI Setup</h3>
                    <p class="text-gray-600">Advanced tracking setup with Meta Pixel and Conversion API for accurate data</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-redo text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Retargeting Campaigns</h3>
                    <p class="text-gray-600">Re-engage visitors and create look-alike audiences for maximum reach</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Budget Optimization</h3>
                    <p class="text-gray-600">Strategic budget allocation and bid optimization for maximum ROI</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-file-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Weekly Reporting</h3>
                    <p class="text-gray-600">Detailed performance reports and actionable insights delivered weekly</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Meta Ads Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect package for your business growth</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">✅ Starter Package</h3>
                        <p class="text-gray-600 mb-4">Best for: Local businesses, startups, and personal brands</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">1 Facebook & Instagram Ad Campaign Setup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic Audience Research & Targeting</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Creative Design (1-2 Ad Creatives)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Campaign Monitoring (7 Days)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic Performance Report</span></div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-green-700"><strong>👉 Ideal For:</strong> Page Like Campaign, Boosting a Post, Simple Awareness Ads</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">Get Started</a>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl shadow-xl text-white relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">✅ Growth Package</h3>
                        <p class="text-blue-100 mb-4">Best for: Online shops, service providers, and medium businesses</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">3 Facebook & Instagram Ad Campaigns</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced Audience Targeting (Custom & Lookalike)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Creative Design (4-5 Ad Creatives + Captions)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Meta Pixel Setup + Standard Event Tracking</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Weekly Optimization & A/B Testing</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Retargeting Campaign Setup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Detailed Performance Report (Every 7 Days)</span></div>
                    </div>
                    <div class="bg-white bg-opacity-10 p-4 rounded-lg mb-6">
                        <p class="text-sm text-blue-100"><strong>👉 Ideal For:</strong> Ecommerce Product Ads, Lead Generation Campaigns, Retargeting Customers</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-white text-blue-600 py-3 rounded-lg font-semibold hover:shadow-lg transition text-center">Get Started</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">✅ Pro Package</h3>
                        <p class="text-gray-600 mb-4">Best for: Businesses that want to scale sales with high-performing ads</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Full Funnel Ad Strategy</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Unlimited Facebook & Instagram Campaigns</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Premium Creative Design (Video + Image + Carousel)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Advanced Pixel + Conversion API Setup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Custom Retargeting & Dynamic Ads</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Daily Campaign Monitoring & Optimization</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">In-depth Analytics Dashboard + ROI Tracking</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Monthly Strategy Call + Consultancy</span></div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-purple-700"><strong>👉 Ideal For:</strong> High-volume Ecommerce, Agencies, or Brands looking to scale big</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">Contact Sales</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">📞 Ready to Grow?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Book your FREE Meta Ads consultation today and discover how we can help you reach more customers and increase sales!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Book FREE Consultation</a>
                <a href="/maktoz/blog/index.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition">View Our Portfolio</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
