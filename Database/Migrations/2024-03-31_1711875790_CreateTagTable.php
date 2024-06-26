<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateTagTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE tags (
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                tag_name VARCHAR(255) NOT NULL
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE tags"
        ];
    }
}