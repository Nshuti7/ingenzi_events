-- Database setup for Ingenzi Events
-- Run this script in phpMyAdmin or MySQL command line

-- Create database
CREATE DATABASE IF NOT EXISTS ingenzi_events_db;
USE ingenzi_events_db;

-- Create events table
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create registrations table
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    event_id INT NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample events
INSERT INTO events (event_name, event_date, description) VALUES
('Community Tech Workshop', '2025-08-15', 'Join us for an exciting workshop on modern web technologies. Learn HTML, CSS, JavaScript, PHP, and MySQL. Perfect for beginners and intermediate developers. Free admission with registration.'),
('Local Art Exhibition', '2025-09-20', 'Discover amazing local artists and their beautiful creations. This exhibition showcases paintings, sculptures, and digital art from talented community members. Refreshments will be provided.'),
('Youth Leadership Summit', '2025-10-25', 'A day dedicated to empowering young leaders in our community. Interactive sessions, networking opportunities, and inspiring speakers. Open to all young people aged 16-25.'),
('Health & Wellness Fair', '2025-11-01', 'Free health screenings, fitness demonstrations, and wellness tips from healthcare professionals. Family-friendly event with activities for all ages.'),
('Business Networking Event', '2025-12-05', 'Connect with local entrepreneurs and business professionals. Share ideas, build partnerships, and grow your network. Light refreshments and business card exchange included.');

-- Display the created tables
SHOW TABLES;

-- Display sample events
SELECT * FROM events; 