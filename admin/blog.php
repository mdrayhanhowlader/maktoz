<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
requireLogin();

$success = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM blog_posts WHERE id = $id");
    redirect('/maktoz/admin/blog.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = clean($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';
    $excerpt = clean($_POST['excerpt'] ?? '');
    $status  = clean($_POST['status'] ?? 'draft');
    $slug    = createSlug($title);

    if (empty($title) || empty($content)) {
        $error = 'Title and content are required.';
    } else {
        if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
            $id = (int)$_POST['edit_id'];
            $stmt = $conn->prepare("UPDATE blog_posts SET title=?, slug=?, content=?, excerpt=?, status=? WHERE id=?");
            $stmt->bind_param("sssssi", $title, $slug, $content, $excerpt, $status, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO blog_posts (title, slug, content, excerpt, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $title, $slug, $content, $excerpt, $status);
        }
        if ($stmt->execute()) {
            $success = 'Blog post saved successfully!';
        } else {
            $error = 'Something went wrong. Please try again.';
        }
        $stmt->close();
    }
}

$edit_post = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM blog_posts WHERE id = $id");
    $edit_post = $result->fetch_assoc();
}

$posts = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
$unread_contacts = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE is_read = 0")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Posts - Maktoz Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col fixed h-full overflow-y-auto">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-xl font-bold">Maktoz Admin</h1>
                <p class="text-gray-400 text-sm mt-1">Welcome, <?php echo $_SESSION['admin_username']; ?></p>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li><a href="/maktoz/admin/index.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                    <li><a href="/maktoz/admin/contacts.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-envelope mr-3"></i>Contacts<?php if ($unread_contacts > 0): ?><span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?php echo $unread_contacts; ?></span><?php endif; ?></a></li>
                    <li><a href="/maktoz/admin/clients.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-users mr-3"></i>Clients</a></li>
                    <li><a href="/maktoz/admin/services.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-concierge-bell mr-3"></i>Services</a></li>
                    <li><a href="/maktoz/admin/billing.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-file-invoice-dollar mr-3"></i>Billing</a></li>
                    <li><a href="/maktoz/admin/reports.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-chart-bar mr-3"></i>Reports</a></li>
                    <li><a href="/maktoz/admin/team.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-user-friends mr-3"></i>Team</a></li>
                    <li><a href="/maktoz/admin/blog.php" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white"><i class="fas fa-blog mr-3"></i>Blog Posts</a></li>
                    <li class="mt-4 border-t border-gray-700 pt-4">
                        <a href="/maktoz/index.php" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition"><i class="fas fa-globe mr-3"></i>View Website</a>
                    </li>
                    <li><a href="/maktoz/admin/logout.php" class="flex items-center px-4 py-3 rounded-lg text-red-400 hover:bg-gray-700 transition"><i class="fas fa-sign-out-alt mr-3"></i>Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Blog Posts</h2>

            <?php if ($success): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-check-circle mr-2"></i><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6"><i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6"><?php echo $edit_post ? 'Edit Post' : 'Add New Post'; ?></h3>
                <form method="POST" action="/maktoz/admin/blog.php">
                    <?php if ($edit_post): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_post['id']; ?>" />
                    <?php endif; ?>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="<?php echo $edit_post ? clean($edit_post['title']) : ''; ?>" placeholder="Post title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition">
                                <option value="draft" <?php echo ($edit_post && $edit_post['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo ($edit_post && $edit_post['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Excerpt</label>
                        <input type="text" name="excerpt" value="<?php echo $edit_post ? clean($edit_post['excerpt']) : ''; ?>" placeholder="Short description" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                        <textarea name="content" rows="8" placeholder="Write your post content here..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none" required><?php echo $edit_post ? $edit_post['content'] : ''; ?></textarea>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fas fa-save mr-2"></i><?php echo $edit_post ? 'Update Post' : 'Save Post'; ?>
                        </button>
                        <?php if ($edit_post): ?>
                            <a href="/maktoz/admin/blog.php" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition"><i class="fas fa-times mr-2"></i>Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Posts List -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">All Posts</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-500 text-sm border-b">
                                <th class="pb-3">#</th>
                                <th class="pb-3">Title</th>
                                <th class="pb-3">Excerpt</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Date</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php while ($post = $posts->fetch_assoc()): ?>
                            <tr class="text-sm">
                                <td class="py-3 text-gray-500"><?php echo $post['id']; ?></td>
                                <td class="py-3 font-semibold text-gray-900"><?php echo clean($post['title']); ?></td>
                                <td class="py-3 text-gray-600 max-w-xs truncate"><?php echo clean($post['excerpt']) ?: '-'; ?></td>
                                <td class="py-3">
                                    <?php if ($post['status'] === 'published'): ?>
                                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Published</span>
                                    <?php else: ?>
                                        <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-gray-500"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></td>
                                <td class="py-3">
                                    <div class="flex space-x-3">
                                        <a href="/maktoz/admin/blog.php?edit=<?php echo $post['id']; ?>" class="text-blue-600 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/maktoz/blog/post.php?slug=<?php echo $post['slug']; ?>" target="_blank" class="text-green-600 hover:text-green-700" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="/maktoz/admin/blog.php?delete=<?php echo $post['id']; ?>" class="text-red-600 hover:text-red-700" title="Delete" onclick="return confirm('Delete this post?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
