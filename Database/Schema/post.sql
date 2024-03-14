CREATE TABLE IF NOT EXISTS  post (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    user_id INT, FOREIGN KEY (user_id) REFERENCES user(id)
)