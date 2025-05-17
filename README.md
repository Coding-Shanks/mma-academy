MMA & UFC Training Website 🥊💻

A responsive, dynamic website for an MMA and UFC training academy, built with HTML, CSS (Tailwind CSS), JavaScript (Three.js), PHP, and MySQL. Features include a blog with image uploads, individual post pages, a contact form, and interactive animations. Perfect for web developers and MMA enthusiasts looking to create a professional training platform.
📖 Table of Contents

Features
Technologies
Screenshots
Setup Instructions
Usage
Project Structure
Contributing
License
Contact

✨ Features

Responsive Design: Mobile-friendly layout using Tailwind CSS.
Dynamic Blog: Create and display blog posts with image uploads, stored in MySQL.
Individual Post Pages: Enhanced single-post pages with full-size images, comments, related posts, and social sharing.
Contact Form: Submit inquiries stored in the database with validation.
Interactive Animations: Three.js torus knot animation in the hero section.
Admin Panel: Upload blog posts and images via a secure admin interface.
SEO Optimized: Structured for search engine visibility.

🛠 Technologies

Frontend: HTML, Tailwind CSS, JavaScript, Three.js
Backend: PHP, MySQL
Dependencies:
Tailwind CSS (CDN)
Three.js (CDN)


Tools: Apache/Nginx, MySQL, Git

📸 Screenshots



Homepage
Blog Page










Single Post
Admin Upload







⚙️ Setup Instructions
Prerequisites

Web Server: Apache or Nginx with PHP (7.4+)
Database: MySQL or MariaDB
Tools: Git, Composer (optional for PHP dependencies)
Browser: Modern browser (Chrome, Firefox, etc.)

Steps

Clone the Repository:
git clone https://github.com/Coding-Shanks/mma-academy.git
cd mma-academy


Set Up the Database:

Create a MySQL database named mma_academy.
Import the database.sql file:mysql -u your_username -p mma_academy < database.sql


Update config.php with your database credentials:<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "mma_academy";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>




Configure the Web Server:

Place the mma-academy/ folder in your web server's root (e.g., /var/www/html/ for Apache).
Ensure the images/ folder is writable:chmod 755 images/
chmod 644 images/*




Add Images:

Ensure the images/ folder contains:
hero-bg.jpg, fighter1.jpg, fighter2.jpg, fighter3.jpg, coach.jpg, training.jpg, gym.jpg, fallback.jpg
Blog images: striking-techniques.jpg, nutrition-tips.jpg, ground-game.jpg, blog-placeholder.jpg


Optimize images (<500KB) for performance.


Test the Website:

Start your web server (e.g., Apache: sudo systemctl start apache2).
Access http://localhost/mma-academy/index.html in a browser.
Verify features:
Homepage with Three.js animation
Blog page (blog.php) with post previews
Single post page (single_post.php?id=1) with full-size images and comments
Contact form (contact.php) submission
Admin blog upload (admin_upload.php)





🚀 Usage

Browse the Website:
Start at index.html for the homepage.
Navigate to blog.php for blog posts, click "Read More" for individual posts.
Use contact.php to submit inquiries.


Admin Tasks:
Access admin_upload.php to upload blog posts and images (add authentication in production).
Images are saved to images/ and paths stored in blog_posts.


Database Management:
View inquiries in the inquiries table.
Manage blog posts in the blog_posts table.
Check comments in the comments table.



📂 Project Structure
mma-academy/
├── index.html              # Homepage
├── programs.html           # Training programs
├── resources.html          # Resources page
├── about.html              # About page
├── contact.php             # Contact form
├── blog.php                # Blog list with previews
├── single_post.php         # Individual blog post page
├── testimonials.html       # Testimonials page
├── schedule.html           # Schedule page
├── admin_upload.php        # Admin blog post upload
├── submit_contact.php      # Contact form handler
├── styles.css              # Custom CSS
├── script.js               # JavaScript (Three.js, smooth scrolling)
├── config.php              # Database configuration
├── database.sql            # MySQL schema
├── images/                 # Images for website and blogs
└── screenshots/            # Screenshots for README

🤝 Contributing
Contributions are welcome! Follow these steps:

Fork the repository.
Create a branch: git checkout -b feature/your-feature.
Commit changes: git commit -m "Add your feature".
Push to the branch: git push origin feature/your-feature.
Open a pull request with a clear description.

Ideas for Contributions

Add a comment submission form for single_post.php.
Implement user authentication for admin_upload.php.
Enhance Three.js animations on the homepage.
Add search functionality to blog.php.

📜 License
This project is licensed under the MIT License. See the LICENSE file for details.
📬 Contact

GitHub Issues: Open an issue
Social: Twitter | Instagram | Facebook


⭐ Star this repository if you find it helpful!📹 Check out the YouTube tutorial for a step-by-step guide to building this project!
