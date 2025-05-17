
# 🥊 MMA & UFC Training Website

A responsive, dynamic website for an MMA and UFC training academy, built with **HTML**, **Tailwind CSS**, **JavaScript (Three.js)**, **PHP**, and **MySQL**. The platform includes a dynamic blog, image uploads, a contact form, an admin panel, and 3D animations — ideal for developers and MMA enthusiasts looking to create a professional training platform.

---

## 📖 Table of Contents

- [✨ Features](#-features)
- [🛠 Technologies](#-technologies)
- [📸 Screenshots](#-screenshots)
- [⚙️ Setup Instructions](#️-setup-instructions)
- [🚀 Usage](#-usage)
- [📂 Project Structure](#-project-structure)
- [🤝 Contributing](#-contributing)
- [📜 License](#-license)
- [📬 Contact](#-contact)

---

## ✨ Features

- **Responsive Design**: Mobile-friendly layout using Tailwind CSS.
- **Dynamic Blog**: Post blogs with image uploads stored in MySQL.
- **Individual Post Pages**: Full-size images, comments, related posts, and social sharing.
- **Contact Form**: Submits and stores inquiries in the database with validation.
- **Interactive Animations**: 3D torus knot using Three.js in the hero section.
- **Admin Panel**: Secure interface to upload blog posts and images.
- **SEO Optimized**: Clean, structured layout for search engine visibility.

---

## 🛠 Technologies

**Frontend**  
- HTML  
- Tailwind CSS (CDN)  
- JavaScript (Three.js via CDN)

**Backend**  
- PHP  
- MySQL

**Tools**  
- Apache/Nginx  
- Git  
- MySQL Workbench  
- Composer (optional for PHP dependency management)

---

## 📸 Screenshots

> Screenshots are located in the `/screenshots/` folder.

- Homepage  
- Blog Page  
- Single Post  
- Admin Upload Panel

---

## ⚙️ Setup Instructions

### ✅ Prerequisites

- Web Server: Apache or Nginx with PHP 7.4+
- MySQL or MariaDB
- Git
- Composer (optional)
- Modern Browser (Chrome, Firefox, etc.)

### 📦 Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/mma-academy.git
   cd mma-academy
   ```

2. **Set Up the Database**

   * Create a MySQL database named `mma_academy`.
   * Import the provided schema:

     ```bash
     mysql -u your_username -p mma_academy < database.sql
     ```

3. **Configure `config.php`**
   Update the database credentials:

   ```php
   <?php
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
   ```

4. **Web Server Setup**

   * Place the project folder in your server root (`/var/www/html/` for Apache).
   * Ensure permissions for image uploads:

     ```bash
     chmod 755 images/
     chmod 644 images/*
     ```

5. **Add Images**
   Place the following images in the `images/` folder:

   * Site images: `hero-bg.jpg`, `fighter1.jpg`, `coach.jpg`, etc.
   * Blog images: `striking-techniques.jpg`, `nutrition-tips.jpg`, `blog-placeholder.jpg`
   * Optimize all images to be under 500KB.

6. **Test the Website**

   * Start your server:

     ```bash
     sudo systemctl start apache2
     ```
   * Visit in browser:
     `http://localhost/mma-academy/index.html`

   Verify:

   * Homepage animation (Three.js)
   * Blog previews (`blog.php`)
   * Individual blog pages (`single_post.php?id=1`)
   * Contact form (`contact.php`)
   * Admin panel (`admin_upload.php`)

---

## 🚀 Usage

### 🌐 Browsing

* Navigate from `index.html` to all pages.
* View blog posts via `blog.php`.
* Submit inquiries via `contact.php`.

### 🔐 Admin Tasks

* Use `admin_upload.php` to post blogs and upload images.
* Add basic authentication for production security.

### 🗃 Database Overview

* `blog_posts` – stores blog content and image paths
* `comments` – stores comments for individual posts
* `inquiries` – stores submitted messages from contact form

---

## 📂 Project Structure

```
mma-academy/
├── index.html              # Homepage
├── programs.html           # Training programs
├── resources.html          # Resources page
├── about.html              # About page
├── contact.php             # Contact form
├── blog.php                # Blog listing
├── single_post.php         # Full blog post page
├── testimonials.html       # Testimonials
├── schedule.html           # Class schedule
├── admin_upload.php        # Admin upload panel
├── submit_contact.php      # Contact form handler
├── styles.css              # Custom styles
├── script.js               # JS (Three.js, smooth scroll)
├── config.php              # Database connection
├── database.sql            # DB schema
├── images/                 # All images
└── screenshots/            # UI screenshots
```

---

## 🤝 Contributing

Contributions are welcome!
To contribute:

1. Fork the repository
2. Create a branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add new feature"`
4. Push the branch: `git push origin feature/your-feature`
5. Open a pull request

### Contribution Ideas

* Add comment submission to `single_post.php`
* Secure `admin_upload.php` with authentication
* Improve 3D visuals on homepage
* Add search functionality to `blog.php`

---

## 📜 License

This project is licensed under the **MIT License**.
See the [LICENSE](LICENSE) file for details.

---

## 📬 Contact

* **Email**: [info@mmaacademy.com](mailto:info@mmaacademy.com)
* **GitHub Issues**: [Open an issue](https://github.com/Coding-Shanks/mma-academy/issues)
* **Social**: [Twitter](#) | [Instagram](#) | [Facebook](#)

---

⭐ *Star this repo if you find it useful!*
📹 *Check out the YouTube tutorial for a step-by-step build!*
