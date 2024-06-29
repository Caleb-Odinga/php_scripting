CREATE DATABASE campaign_feedback;

USE campaign_feedback;

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    feedback TEXT NOT NULL,
    rating INT NOT NULL,
    submission_date DATETIME DEFAULT CURRENT_TIMESTAMP
);
