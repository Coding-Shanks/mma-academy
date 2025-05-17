<?php
require_once 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $image_url = null;

    // Validate inputs
    if (empty($title) || empty($content)) {
        $_SESSION['error'] = "Title and content are required.";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'images/';
            $image_name = uniqid('blog_') . '_' . basename($_FILES['image']['name']);
            $image_path = $upload_dir . $image_name;

            // Validate image type and size (e.g., max 5MB, only JPG/PNG)
            $allowed_types = ['image/jpeg', 'image/png'];
            $max_size = 5 * 1024 * 1024; // 5MB
            $image_info = getimagesize($_FILES['image']['tmp_name']);

            if (!in_array($image_info['mime'], $allowed_types)) {
                $_SESSION['error'] = "Only JPG and PNG images are allowed.";
            } elseif ($_FILES['image']['size'] > $max_size) {
                $_SESSION['error'] = "Image size exceeds 5MB.";
            } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image_url = $image_path;
            } else {
                $_SESSION['error'] = "Failed to upload image.";
            }
        }

        // If no image error, save to database
        if (!isset($_SESSION['error'])) {
            try {
                $sql = "INSERT INTO blog_posts (title, content, image_url) VALUES (:title, :content, :image_url)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':image_url', $image_url);
                $stmt->execute();
                $_SESSION['success'] = "Blog post uploaded successfully!";
            } catch(PDOException $e) {
                $_SESSION['error'] = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Blog Post - MMA Academy</title>
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

    <!-- Upload Form -->
    <section id="upload" class="py-16 px-4 pt-24">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">Upload Blog Post</h2>
            <div class="max-w-lg mx-auto bg-gray-700 p-8 rounded-lg shadow-lg card">
                <?php if (isset($_SESSION['success'])) { ?>
                    <p class="text-green-500 mb-4"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <p class="text-red-500 mb-4"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php } ?>
                <form method="POST" action="admin_upload.php" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium mb-1">Title</label>
                        <input id="title" name="title" type="text" class="w-full bg-gray-800 p-2 rounded" aria-label="Title" required>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium mb-1">Content</label>
                        <textarea id="content" name="content" class="w-full bg-gray-800 p-2 rounded" rows="8" aria-label="Content" required></textarea>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium mb-1">Image (JPG/PNG, max 5MB)</label>
                        <input id="image" name="image" type="file" accept="image/jpeg,image/png" class="w-full bg-gray-800 p-2 rounded" aria-label="Image">
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">Upload Post</button>
                </form>
            </div>
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