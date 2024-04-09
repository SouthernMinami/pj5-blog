<?php


namespace Database\Migrations;

require_once 'vendor/autoload.php';

use Database\SchemaMigration;
use Carbon\Carbon;

class CreateCarsTable implements SchemaMigration
{
    public function up(): array
    {
        $now = Carbon::now();
        // マイグレーション処理を書く
        return [
            "CREATE TABLE cars (
                id INT PRIMARY KEY AUTO_INCREMENT,
                make VARCHAR(255) NOT NULL,
                model VARCHAR(255) NOT NULL,
                year INT NOT NULL,
                color VARCHAR(255) NOT NULL,
                price FLOAT NOT NULL,
                mileage FLOAT NOT NULL,
                transmission VARCHAR(255) NOT NULL,
                engine VARCHAR(255) NOT NULL,
                status VARCHAR(255) NOT NULL,
                created_at TIMESTAMP,
                updated_at TIMESTAMP 
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