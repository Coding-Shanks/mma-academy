<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MMA Academy</title>
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
            </ul>
        </div>
    </nav>

    <!-- Contact Form -->
    <section id="contact" class="py-16 px-4 pt-24">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in">Contact Us</h2>
            <div class="max-w-lg mx-auto bg-gray-700 p-8 rounded-lg shadow-lg card">
                <?php if (isset($_SESSION['success'])) { ?>
                    <p class="text-green-500 mb-4"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <p class="text-red-500 mb-4"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php } ?>
                <form method="POST" action="submit_contact.php" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Name</label>
                        <input id="name" name="name" type="text" class="w-full bg-gray-800 p-2 rounded" aria-label="Name" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input id="email" name="email" type="email" class="w-full bg-gray-800 p-2 rounded" aria-label="Email" required>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium mb-1">Message</label>
                        <textarea id="message" name="message" class="w-full bg-gray-800 p-2 rounded" rows="5" aria-label="Message" required></textarea>
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">Send Message</button>
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