<?php
require_once 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$post_id = $_GET['id'];

try {
    // Fetch the current post
    $sql = "SELECT * FROM blog_posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        header("Location: blog.php");
        exit();
    }

    // Fetch related posts (exclude current post)
    $sql_related = "SELECT * FROM blog_posts WHERE id != :id ORDER BY created_at DESC LIMIT 3";
    $stmt_related = $conn->prepare($sql_related);
    $stmt_related->bindParam(':id', $post_id, PDO::PARAM_INT);
    $stmt_related->execute();
    $related_posts = $stmt_related->fetchAll(PDO::FETCH_ASSOC);

    // Fetch comments for the post
    $sql_comments = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC";
    $stmt_comments = $conn->prepare($sql_comments);
    $stmt_comments->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt_comments->execute();
    $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = "Error fetching blog post: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - MMA Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-gray-800 shadow-lg z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.html" class="text-3xl font-bold text-red-600">MMA Academy</a>
            <ul class="flex space-x-6">
                <li><a href="index.html" class="hover:text-red-600 transition">Home</a></li>
                <li><a href="programs.html" class="hover:text-red-600 transition">Programs</a></li>
                <li><a href="resources.html" class="hover:text-red-600 transition">Resources</a></li>
                <li><a href="about.html" class="hover:text-red-600 transition">About</a></li>
                <li><a href="testimonials.html" class="hover:text-red-600 transition">Testimonials</a></li>
                <li><a href="schedule.html" class="hover:text-red-600 transition">Schedule</a></li>
                <li><a href="blog.php" class="hover:text-red-600 transition">Blog</a></li>
                <li><a href="contact.php" class="hover:text-red-600 transition">Contact</a></li>
                <li><a href="admin_upload.php" class="hover:text-red-600 transition">Upload Blog</a></li>
            </ul>
        </div>
    </nav>

    <!-- Single Post Section -->
    <section id="single-post" class="py-16 px-4 pt-24">
        <div class="container mx-auto">
            <?php if (isset($error)) { ?>
                <p class="text-red-500 text-center mb-8"><?php echo $error; ?></p>
            <?php } else { ?>
                <!-- Hero Header -->
                <div class="relative mb-12 bg-cover bg-center h-80 rounded-lg" style="background-image: url('<?php echo htmlspecialchars(!empty($post['image_url']) && file_exists($post['image_url']) ? $post['image_url'] : 'images/fallback.jpg'); ?>')">
                    <div class="absolute inset-0 bg-black bg-opacity-60 rounded-lg"></div>
                    <div class="relative flex items-center justify-center h-full">
                        <h1 class="text-4xl md:text-5xl font-bold text-center animate-fade-in"><?php echo htmlspecialchars($post['title']); ?></h1>
                    </div>
                </div>

                <!-- Main Content and Sidebar -->
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Main Post Content -->
                    <div class="md:w-2/3">
                        <div class="bg-gray-700 p-8 rounded-lg shadow-lg card animate-slide-in">
                            <?php
                            $image_url = !empty($post['image_url']) && file_exists($post['image_url']) ? $post['image_url'] : 'images/fallback.jpg';
                            ?>
                            <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Blog Image" class="w-full max-h-[600px] object-contain rounded-lg mb-6 fallback-image">
                            <p class="text-sm text-gray-400 mb-6">Posted on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
                            <p class="mb-6"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

                            <!-- Social Sharing -->
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-4">Share This Post</h3>
                                <div class="flex space-x-4">
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://yourdomain.com/single_post.php?id=' . $post_id); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Twitter</a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://yourdomain.com/single_post.php?id=' . $post_id); ?>" target="_blank" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">Facebook</a>
                                    <a href="#" onclick="alert('Copy the link to share on Instagram: http://yourdomain.com/single_post.php?id=<?php echo $post_id; ?>')" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition">Instagram</a>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div>
                                <h3 class="text-xl font-semibold mb-4">Comments</h3>
                                <?php if (empty($comments)) { ?>
                                    <p class="text-gray-400">No comments yet. Be the first to share your thoughts!</p>
                                <?php } else { ?>
                                    <div class="space-y-4">
                                        <?php foreach ($comments as $comment) { ?>
                                            <div class="bg-gray-800 p-4 rounded-lg animate-slide-in">
                                                <p class="font-semibold"><?php echo htmlspecialchars($comment['name']); ?></p>
                                                <p class="text-sm text-gray-400"><?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?></p>
                                                <p class="mt-2"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <a href="blog.php" class="text-red-600 hover:underline mt-6 inline-block">Back to Blog</a>
                        </div>
                    </div>

                    <!-- Sidebar with Related Posts -->
                    <div class="md:w-1/3">
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg card animate-slide-in">
                            <h3 class="text-xl font-semibold mb-4">Related Posts</h3>
                            <?php if (empty($related_posts)) { ?>
                                <p class="text-gray-400">No related posts available.</p>
                            <?php } else { ?>
                                <div class="space-y-6">
                                    <?php foreach ($related_posts as $related) { ?>
                                        <div>
                                            <?php
                                            $related_image = !empty($related['image_url']) && file_exists($related['image_url']) ? $related['image_url'] : 'images/fallback.jpg';
                                            ?>
                                            <a href="single_post.php?id=<?php echo $related['id']; ?>">
                                                <img src="<?php echo htmlspecialchars($related_image); ?>" alt="Related Post Image" class="w-full h-40 object-cover rounded-lg mb-2 fallback-image">
                                            </a>
                                            <a href="single_post.php?id=<?php echo $related['id']; ?>" class="text-red-600 hover:underline"><?php echo htmlspecialchars($related['title']); ?></a>
                                            <p class="text-sm text-gray-400"><?php echo date('F j, Y', strtotime($related['created_at'])); ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto text-center">
            <p class="mb-4 text-lg">Email: info@mmaacademy.com</p>
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-red-600 hover:text-red-700 transition text-lg" aria-label="Twitter">Twitter</a>
                <a href="#" class="text-red-600 hover:text-red-700 transition text-lg" aria-label="Instagram">Instagram</a>
                <a href="#" class="text-red-600 hover:text-red-700 transition text-lg" aria-label="Facebook">Facebook</a>
            </div>
            <p class="mt-4">© 2025 MMA Academy. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>