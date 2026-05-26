CREATE DATABASE db_crud;

USE db_crud;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(100),
);

INSERT INTO users (username, password) 
VALUES ('admin', '12345');

CREATE TABLE identitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    alamat VARCHAR(100)
);