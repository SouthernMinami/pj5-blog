<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateSubscriptionTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE subscriptions(
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                subscription_name VARCHAR(255) NOT NULL,
                subscription_status VARCHAR(255) NOT NULL,
                subscription_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                subscription_end_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                user_id BIGINT,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )
            ALTER TABLE users 
                DROP COLUMN subscription, 
                DROP COLUMN subscription_status, 
                DROP COLUMN subscription_created_at, 
                DROP COLUMN subscription_end_at
            "
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE subscriptions,
            ALTER TABLE users 
                ADD COLUMN subscription VARCHAR(255) NOT NULL DEFAULT,
                ADD COLUMN subscription_status VARCHAR(255) NOT NULL,
                ADD COLUMN subscription_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                ADD COLUMN subscription_end_at DATETIME DEFAULT CURRENT_TIMESTAMP
            "
        ];
    }
}