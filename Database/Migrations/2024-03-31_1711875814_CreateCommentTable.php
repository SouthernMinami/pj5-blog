<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCommentTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "
                CREATE TABLE comments (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    comment_text VARCHAR(255) NOT NULL,
                    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    user_id INT,
                    post_id INT,
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (post_id) REFERENCES posts(id)
            "
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE comments"
        ];
    }
}