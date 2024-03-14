CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_confirmed_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
) 