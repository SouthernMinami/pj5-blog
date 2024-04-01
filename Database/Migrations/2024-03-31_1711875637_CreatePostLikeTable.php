<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreatePostLikeTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE post_likes (
                user_id INT PRIMARY KEY AUTO_INCREMENT,
                post_id INT PRIMARY KEY AUTO_INCREMENT,
                FOREIGN KEY (user_id) PREFERENCES (users),
                FOREIGN KEY (post_id) PREFERENCES (posts)
            "
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE post_likes"
        ];
    }
}