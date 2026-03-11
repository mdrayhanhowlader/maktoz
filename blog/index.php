<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
$page_title = 'Blog';
require_once '../includes/header.php';

$posts = $conn->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
?>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <nav class="text-sm">
                <ol class="flex items-center space-x-2">
                    <li><a href="/maktoz/index.php" class="text-blue-600 hover:text-blue-700">Home</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-gray-600">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Blog</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Latest insights, tips and news from the world of digital marketing</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $count = 0; while ($post = $posts->fetch_assoc()): $count++; ?>
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-48 flex items-center justify-center">
                        <i class="fas fa-blog text-white text-5xl opacity-50"></i>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3"><?php echo clean($post['title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo clean($post['excerpt']) ?: substr(strip_tags($post['content']), 0, 120) . '...'; ?></p>
                        <a href="/maktoz/blog/post.php?slug=<?php echo $post['slug']; ?>" class="text-blue-600 font-semibold hover:text-blue-700 transition">Read More →</a>
                    </div>
                </div>
                <?php endwhile; ?>

                <?php if ($count === 0): ?>
                <div class="col-span-3 text-center py-20">
                    <i class="fas fa-blog text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-xl">No blog posts yet. Check back soon!</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php require_once '../includes/footer.php'; ?>
