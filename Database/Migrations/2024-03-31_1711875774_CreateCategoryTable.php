<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCategoryTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE categories (
                id INT PRIMARY KEY AUTO_INCREMENT,
                category_name VARCHAR(255) NOT NULL,
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE categories"
        ];
    }
}