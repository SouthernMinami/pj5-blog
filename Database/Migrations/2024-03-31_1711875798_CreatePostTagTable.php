<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreatePostTagTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE post_tags (
                post_id INT PRIMARY KEY AUTO_INCREMENT,
                tag_id INT PRIMARY KEY AUTO_INCREMENT,
                FOREIGN KEY (post_id) PREFERENCES (posts),
                FOREIGN KEY (tag_id) PREFERENCES (tags)
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE post_tags"
        ];
    }
}