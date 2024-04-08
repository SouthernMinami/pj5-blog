<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCarsTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE IF NOT EXISTS cars (
                id INT PRIMARY KEY AUTO_INCREMENT,
                make VARCHAR(255) NOT NULL,
                model VARCHAR(255) NOT NULL,
                year INT NOT NULL,
                 color VARCHAR(255) NOT NULL,
                 price FLOAT NOT NULL,
                 mileage FLOAT NOT NULL,
                 transmission VARCHAR(255) NOT NULL,
                 engine VARCHAR(255) NOT NULL,
                 status VARCHAR(255) NOT NULL
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE cars"
        ];
    }
}