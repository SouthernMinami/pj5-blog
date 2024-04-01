<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCommentLikeTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE comment_likes (
                user_id INT PRIMARY KEY AUTO_INCREMENT,
                comment_id INT PRIMARY KEY AUTO_INCREMENT,
                FOREIGN KEY (user_id) PREFERENCES (users),
                FOREIGN KEY (comment_id) PREFERENCES (comments)    
            "
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE comment_likes"
        ];
    }
}