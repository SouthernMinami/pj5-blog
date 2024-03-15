CREATE TABLE IF NOT EXISTS user_setting (
    entry_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, FOREIGN KEY (user_id) REFERENCES user(id),
    metaKey VARCHAR(50) NOT NULL,
    metaValue VARCHAR(255) NOT NULL
);