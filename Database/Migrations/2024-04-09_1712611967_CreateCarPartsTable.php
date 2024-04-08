<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateCarPartsTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE IF NOT EXISTS car_parts (
                id INT PRIMARY KEY AUTO_INCREMENT,
                car_id INT NOT NULL,
                FOREIGN KEY (car_id) REFERENCES cars(id),
                name VARCHAR(255) NOT NULL,
                description TEXT,
                price FLOAT NOT NULL,
                quantity_in_stock INT NOT NULL
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE car_parts"
        ];
    }
}