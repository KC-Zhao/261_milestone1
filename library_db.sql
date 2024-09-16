CREATE DATABASE library_db;

USE library_db;

CREATE TABLE Books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publisher VARCHAR(255),
    isbn VARCHAR(13),
    published_year YEAR,
    category VARCHAR(100),
    copies_available INT DEFAULT 1
);

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'member') DEFAULT 'member',
    email VARCHAR(255),
    phone VARCHAR(15),
    address VARCHAR(255),
    membership_date DATE DEFAULT CURRENT_DATE
);

CREATE TABLE BorrowedBooks (
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    borrow_date DATE,
    due_date DATE,
    return_date DATE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (book_id) REFERENCES Books(book_id)
);

INSERT INTO Users (username, password, role) 
VALUES ('admin', 'admin123', 'admin');
