<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
$page_title = 'Custom Web Applications & Automation Solutions';
require_once 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">Custom Web Applications & Automation</li>
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
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-cogs text-white text-2xl"></i>
                        </div>
                        <span class="text-indigo-600 font-semibold text-lg">CUSTOM WEB APPLICATIONS & AUTOMATION</span>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Build Powerful
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Custom Solutions</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">Streamline operations, integrate systems, and build bespoke apps that push your business forward with cutting-edge technology.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition text-center">Get FREE Strategy Session</a>
                        <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold hover:border-blue-600 hover:text-blue-600 transition">View Portfolio</button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="https://placehold.co/600x400/6366F1/FFFF?text=Custom+Web+Apps" alt="Custom Web Applications" class="rounded-2xl shadow-2xl" />
                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-semibold">99.9% Uptime</span>
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
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive custom development and automation solutions tailored to your business needs</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bespoke Web & Mobile App Development</h3>
                    <p class="text-gray-600">React, Vue, Laravel, Django, Node.js - full-stack solutions</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-robot text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Business Process Automation</h3>
                    <p class="text-gray-600">Zapier, Make/Integromat, custom scripts & intelligent bots</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-plug text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">API & Third-Party Integrations</h3>
                    <p class="text-gray-600">Payments, CRM, ERP, logistics - seamless connections</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-tasks text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Workflow & RPA Solutions</h3>
                    <p class="text-gray-600">Robotic process automation for repetitive tasks</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Custom Dashboards & Data Visualization</h3>
                    <p class="text-gray-600">Power BI, Grafana, Looker - actionable insights</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-r from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                        <i class="fas fa-cloud text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Cloud Deployment & CI/CD</h3>
                    <p class="text-gray-600">AWS, Azure, GCP - scalable infrastructure solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Custom Development & Automation Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect development package for your project needs</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">1️⃣ MVP Development Package</h3>
                        <p class="text-gray-600 mb-4">Start-up Ready</p>
                        <div class="text-3xl font-bold text-green-600 mb-2">৳85,000 - ৳150,000</div>
                        <p class="text-sm text-gray-500">Project-based pricing</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic Web/Mobile App (3-5 core features)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">User Authentication & Basic Dashboard</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Database Design & API Development</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Basic Automation (2-3 workflows)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">Cloud Deployment (Basic)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-500 mr-3 mt-1"></i><span class="text-gray-700">30 Days Post-Launch Support</span></div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-green-700"><strong>Timeline:</strong> 4-8 weeks</p>
                        <p class="text-sm text-green-700"><strong>Ideal For:</strong> Start-ups, MVPs, Simple Apps</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">Get Started</a>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-8 rounded-2xl shadow-xl text-white relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</div>
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-cogs text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">2️⃣ Professional Development Package</h3>
                        <p class="text-blue-100 mb-4">Business Growth</p>
                        <div class="text-3xl font-bold mb-2">৳200,000 - ৳400,000</div>
                        <p class="text-sm text-blue-100">Project-based pricing</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Full-Featured Web/Mobile App</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced User Management & Roles</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Complex Business Logic & Workflows</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">API Integrations (5-8 third-party)</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Advanced Automation & RPA</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Custom Dashboard & Analytics</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">Scalable Cloud Infrastructure</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-green-400 mr-3 mt-1"></i><span class="text-white">90 Days Support + Documentation</span></div>
                    </div>
                    <div class="bg-white bg-opacity-10 p-4 rounded-lg mb-6">
                        <p class="text-sm text-blue-100"><strong>Timeline:</strong> 8-16 weeks</p>
                        <p class="text-sm text-blue-100"><strong>Ideal For:</strong> SMEs, Growing Businesses</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-white text-blue-600 py-3 rounded-lg font-semibold hover:shadow-lg transition text-center">Get Started</a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">3️⃣ Enterprise Development Package</h3>
                        <p class="text-gray-600 mb-4">Enterprise Scale</p>
                        <div class="text-3xl font-bold text-purple-600 mb-2">৳500,000+</div>
                        <p class="text-sm text-gray-500">Custom quote based on scope</p>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Enterprise-Grade Applications</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Multi-Platform Development</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Complex System Integrations</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Advanced Security & Compliance</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Full Process Automation Suite</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Advanced Analytics & BI</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">High-Availability Infrastructure</span></div>
                        <div class="flex items-start"><i class="fas fa-check text-purple-500 mr-3 mt-1"></i><span class="text-gray-700">Dedicated Team & 1-Year Support</span></div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-purple-700"><strong>Timeline:</strong> 16+ weeks</p>
                        <p class="text-sm text-purple-700"><strong>Ideal For:</strong> Large Enterprises, Complex Systems</p>
                    </div>
                    <a href="/maktoz/contact.php" class="block w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition text-center">Get Custom Quote</a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">📞 Ready to Innovate?</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Turn your idea into a powerful, scalable solution—book your FREE solution-strategy session today!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/maktoz/contact.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Get FREE Strategy Session</a>
                <a href="/maktoz/blog/index.php" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition">View Portfolio</a>
            </div>
        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>
