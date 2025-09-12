-- SQL script to create a 'user' table
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- SQL script to create a 'website_logo' table
CREATE TABLE logo (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imageType VARCHAR(50) NOT NULL,
    imageData LONGBLOB NOT NULL
);

//-- SQL script to create an 'author_requests' table
CREATE TABLE author_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    bio TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

//-- SQL script to create an 'authors' table
CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    bio TEXT,
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP
);