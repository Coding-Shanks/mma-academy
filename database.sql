CREATE DATABASE mma_academy;
USE mma_academy;

CREATE TABLE inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample blog posts
INSERT INTO blog_posts (title, content) VALUES
('Top 5 Striking Techniques for Beginners', 'Learn the essential striking techniques every MMA beginner should master, including jabs, crosses, and roundhouse kicks.'),
('Nutrition Tips for Fighters', 'Discover the best diet strategies to fuel your training and optimize performance in the cage.');