<?php
require_once 'config.php';

try {
    $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = "Error fetching blog posts: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - MMA Academy</title>
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

    <!-- Blog Section -->
    <section id="blog" class="py-16 px-4 pt-24">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">MMA Academy Blog</h2>
            <?php if (isset($error)) { ?>
                <p class="text-red-500 text-center mb-8"><?php echo $error; ?></p>
            <?php } ?>
            <?php if (empty($posts)) { ?>
                <p class="text-center text-gray-400">No blog posts available. Check back soon!</p>
            <?php } else { ?>
                <div class="space-y-12">
                    <?php foreach ($posts as $post) { ?>
                        <div class="bg-gray-700 p-8 rounded-lg shadow-lg card">
                            <?php
                            $image_url = !empty($post['image_url']) && file_exists($post['image_url']) ? $post['image_url'] : 'images/fallback.jpg';
                            ?>
                            <a href="single_post.php?id=<?php echo $post['id']; ?>">
                                <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Blog Image" class="w-full h-96 object-cover rounded-lg mb-6 fallback-image md:h-64">
                            </a>
                            <h3 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="text-sm text-gray-400 mb-4">Posted on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
                            <p class="mb-6">
                                <?php
                                $preview = substr($post['content'], 0, 200);
                                if (strlen($post['content']) > 200) {
                                    $preview .= '...';
                                }
                                echo nl2br(htmlspecialchars($preview));
                                ?>
                            </p>
                            <a href="single_post.php?id=<?php echo $post['id']; ?>" class="text-red-600 hover:underline">Read More</a>
                        </div>
                    <?php } ?>
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