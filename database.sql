-- Database setup for event registration system
CREATE DATABASE IF NOT EXISTS event_registration;
USE event_registration;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Events table  
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    location VARCHAR(255),
    event_date DATETIME NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Registrations table
CREATE TABLE registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id),
    UNIQUE KEY unique_registration (user_id, event_id)
);

-- Insert some sample events (optional)
INSERT INTO events (title, description, location, event_date, created_by) VALUES
('Tech Conference 2025', 'Annual technology conference featuring the latest innovations', 'Convention Center', '2025-09-15 09:00:00', 1),
('Music Festival', 'Three-day music festival with top artists', 'Central Park', '2025-08-20 18:00:00', 1),
('Startup Meetup', 'Networking event for entrepreneurs and investors', 'WeWork Downtown', '2025-08-10 19:00:00', 1);
