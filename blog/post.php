<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

$slug = clean($_GET['slug'] ?? '');

if (empty($slug)) {
    redirect('/maktoz/blog/index.php');
}

$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 'published'");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post) {
    redirect('/maktoz/blog/index.php');
}

$page_title = $post['title'];
require_once '../includes/header.php';
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li><a href="/maktoz/blog/index.php" class="text-blue-600 hover:text-blue-700">Blog</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600"><?php echo clean($post['title']); ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Post Content -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">

                <!-- Post Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-64 rounded-2xl flex items-center justify-center mb-8">
                    <i class="fas fa-blog text-white text-6xl opacity-50"></i>
                </div>

                <div class="flex items-center text-gray-400 text-sm mb-4">
                    <i class="fas fa-calendar mr-2"></i>
                    <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 mb-6"><?php echo clean($post['title']); ?></h1>

                <?php if ($post['excerpt']): ?>
                    <p class="text-xl text-gray-500 mb-8 border-l-4 border-blue-600 pl-4 italic"><?php echo clean($post['excerpt']); ?></p>
                <?php endif; ?>

                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                    <?php echo nl2br(clean($post['content'])); ?>
                </div>

                <!-- Back Button -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <a href="/maktoz/blog/index.php" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Blog
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Grow Your Business?</h2>
                <p class="text-xl text-blue-100 mb-8">Let's discuss how we can help you achieve your digital marketing goals.</p>
                <a href="/maktoz/contact.php" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-lg transition">Get Free Consultation</a>
            </div>
        </div>
    </section>

<?php require_once '../includes/footer.php'; ?>
