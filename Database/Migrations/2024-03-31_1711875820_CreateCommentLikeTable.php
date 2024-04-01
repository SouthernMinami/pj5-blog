<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCommentLikeTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE comment_likes(
                user_id BIGINT,
                comment_id BIGINT,
                PRIMARY KEY (user_id, comment_id),
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE
            )"
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