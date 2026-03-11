<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'SEO Services';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">SEO Services</li>
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
                            <i class="fas fa-search text-white text-2xl"></i>
                        </div>
                        <span class="text-green-600 font-semibold text-lg">SEO OPTIMIZATION</span>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Rank Higher &
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Drive More Traffic</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">Boost visibility, drive organic traffic & turn clicks into customers with proven SEO strategies.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition text-center">Get FREE SEO Audit</a>
                        <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold hover:border-blue-600 hover:text-blue-600 transition">View Case Studies</button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="https://placehold.co/600x400/059669/FFFF?text=SEO+Optimization" alt="SEO Services" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">Proven Results</span>
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
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive SEO solutions to boost your search engine rankings</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-key text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Keyword Research & Competitor Analysis</h3>
                    <p class="text-gray-600">In-depth keyword research and competitor gap analysis</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-cogs text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">On-Page & Technical SEO</h3>
                    <p class="text-gray-600">Complete on-page and technical SEO optimization</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-link text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">High-Quality Backlink Outreach</h3>
                    <p class="text-gray-600">Strategic link building and outreach campaigns</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-pen-fancy text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Content Strategy & SEO Blogging</h3>
                    <p class="text-gray-600">SEO-optimized content creation and strategy</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Local & E-commerce SEO</h3>
                    <p class="text-gray-600">Specialized local and e-commerce SEO campaigns</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Monthly Performance Reporting</h3>
                    <p class="text-gray-600">Detailed monthly reports and performance tracking</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">SEO Service Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect SEO package for your business growth</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">1️⃣ Starter SEO Package</h3>
                        <p class="text-gray-600 mb-4">Local Business SEO</p>
                        <div class="text-3xl font-bold text-green-600 mb-2">৳15,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Up to 10 Target Keywords</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic On-Page Optimization</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Google My Business Setup</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Local Citation Building</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Monthly Progress Report</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic Technical SEO Audit</span></div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-green-700"><strong>Ideal For:</strong> Local Businesses, Small Shops</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">Get Started</a>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl shadow-xl text-white relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">2️⃣ Professional SEO Package</h3>
                        <p class="text-blue-100 mb-4">Growth-Focused SEO</p>
                        <div class="text-3xl font-bold mb-2">৳35,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Up to 25 Target Keywords</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced On-Page & Technical SEO</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Content Strategy & 4 SEO Articles</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Link Building Campaign (10 Links)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Competitor Analysis & Monitoring</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Bi-weekly Progress Reports</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Priority Support</span></div>
                    </div>
                    <div class="bg-white bg-opacity-10 p-4 rounded-lg mb-6">
                        <p class="text-sm text-blue-100"><strong>Ideal For:</strong> Growing Businesses, E-commerce</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-white text-blue-600 py-3 rounded-lg font-semibold hover:shadow-lg transition text-center">Get Started</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">3️⃣ Enterprise SEO Package</h3>
                        <p class="text-gray-600 mb-4">Complete SEO Domination</p>
                        <div class="text-3xl font-bold text-purple-600 mb-2">৳65,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Unlimited Target Keywords</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Complete Technical SEO Overhaul</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">8 SEO-Optimized Articles/Month</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Premium Link Building (25+ Links)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Advanced Analytics & Conversion Tracking</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Weekly Reports & Strategy Calls</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Dedicated Account Manager</span></div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-purple-700"><strong>Ideal For:</strong> Large Businesses, Enterprises</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">Get Started</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">📞 Ready to Rank Higher?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Schedule your FREE SEO audit & strategy call and discover how we can boost your search rankings!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Get FREE SEO Audit</a>
                <a href="/maktoz/contact.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition">View Case Studies</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
