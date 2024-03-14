CREATE TABLE IF NOT EXISTS  comment (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    user_id INT, FOREIGN KEY (user_id) REFERENCES user(id),
    post_id INT, FOREIGN KEY (post_id) REFERENCES post(post_id)
)