CREATE DATABASE lab5;

USE lab5;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users(username, password) VALUES
('admin', MD5('123')),
('phat', MD5('123456'));
