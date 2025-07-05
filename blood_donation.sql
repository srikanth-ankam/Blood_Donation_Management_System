CREATE DATABASE IF NOT EXISTS blood_donation;
USE blood_donation;

CREATE TABLE donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    blood_group VARCHAR(10),
    location VARCHAR(100),
    phone VARCHAR(15),
    last_donation_date DATE,
    is_eligible BOOLEAN DEFAULT TRUE
);

CREATE TABLE recipients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    blood_group_needed VARCHAR(10),
    location VARCHAR(100),
    phone VARCHAR(15),
    hospital VARCHAR(100),
    reason TEXT,
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'Pending'
);

CREATE TABLE requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_id INT,
    donor_id INT,
    status VARCHAR(20) DEFAULT 'Pending',
    request_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    donation_date DATETIME,
    FOREIGN KEY (recipient_id) REFERENCES recipients(id),
    FOREIGN KEY (donor_id) REFERENCES donors(id)
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO admins (username, password) VALUES ('admin', 'admin123');
