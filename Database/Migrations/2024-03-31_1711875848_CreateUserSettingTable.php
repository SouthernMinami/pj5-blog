<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateUserSettingTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE user_settings (
                entry_id INT PRIMARY KEY AUTO_INCREMENT,
                user_id BIGINT,
                meta_key VARCHAR(255) NOT NULL,
                meta_value VARCHAR(255) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE user_settings"
        ];
    }
}