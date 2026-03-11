<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'B2B Lead Generation';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">B2B Lead Generation</li>
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
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>
                        <span class="text-orange-600 font-semibold text-lg">B2B LEAD GENERATION</span>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Fill Your Pipeline With
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Quality Leads</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">Connect directly with decision-makers and keep your sales pipeline full with verified, high-quality B2B prospects.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition text-center">Get FREE Strategy Session</a>
                        <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold hover:border-blue-600 hover:text-blue-600 transition">View Sample Leads</button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="https://placehold.co/600x400/EA580C/FFFF?text=B2B+Lead+Generation" alt="B2B Lead Generation" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">95%+ Accuracy Rate</span>
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
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive B2B lead generation solutions to fuel your sales growth</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fab fa-linkedin text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">LinkedIn Outreach to C-Level & VP Targets</h3>
                    <p class="text-gray-600">Direct access to decision-makers and key executives</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Verified Email List Building & Enrichment</h3>
                    <p class="text-gray-600">High-quality, verified email addresses with data enrichment</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-filter text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Advanced Prospect Filters</h3>
                    <p class="text-gray-600">Target by industry, company size, geography, and more</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Google Maps Lead Scraping</h3>
                    <p class="text-gray-600">Local business leads for niche markets and geo-targeting</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-database text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">CRM-Ready Data Delivery</h3>
                    <p class="text-gray-600">Formatted data ready for your CRM with lead qualification</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">B2B Lead Generation Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect lead generation package for your sales goals</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-seedling text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">1️⃣ Starter Lead Package</h3>
                        <p class="text-gray-600 mb-4">Small Business Focus</p>
                        <div class="text-3xl font-bold text-green-600 mb-2">৳12,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">200 Verified Leads/Month</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic LinkedIn Outreach</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Email Verification & Enrichment</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Industry & Location Filtering</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">CSV/Excel Data Delivery</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Monthly Performance Report</span></div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-green-700"><strong>Ideal For:</strong> Small Businesses, Startups</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">Get Started</a>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl shadow-xl text-white relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">2️⃣ Professional Lead Package</h3>
                        <p class="text-blue-100 mb-4">Growth-Focused</p>
                        <div class="text-3xl font-bold mb-2">৳25,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">500 Verified Leads/Month</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced LinkedIn + Email Outreach</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Google Maps Lead Scraping</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced Prospect Filtering</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">CRM Integration Support</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Lead Qualification & Scoring</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Bi-weekly Strategy Calls</span></div>
                    </div>
                    <div class="bg-white bg-opacity-10 p-4 rounded-lg mb-6">
                        <p class="text-sm text-blue-100"><strong>Ideal For:</strong> Growing Agencies, SaaS Companies</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-white text-blue-600 py-3 rounded-lg font-semibold hover:shadow-lg transition text-center">Get Started</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">3️⃣ Enterprise Lead Package</h3>
                        <p class="text-gray-600 mb-4">Scale & Dominate</p>
                        <div class="text-3xl font-bold text-purple-600 mb-2">৳45,000 / month</div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">1000+ Verified Leads/Month</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Multi-Channel Outreach Campaign</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">C-Level & VP Direct Access</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Custom Data Fields & Enrichment</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Full CRM Integration & Automation</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Weekly Strategy & Optimization</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Dedicated Account Manager</span></div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-purple-700"><strong>Ideal For:</strong> Large Enterprises, Consultancies</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">Get Started</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">📞 Ready to Fill Your Pipeline?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Grab a FREE lead-generation strategy session today and discover how we can fill your sales pipeline with quality prospects!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Get FREE Strategy Session</a>
                <a href="/maktoz/contact.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition">View Sample Leads</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
