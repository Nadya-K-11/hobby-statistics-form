CREATE DATABASE mydb 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE mydb;

CREATE TABLE users_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    music TINYINT(1) DEFAULT 0,
    cinema TINYINT(1) DEFAULT 0,
    sports TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;