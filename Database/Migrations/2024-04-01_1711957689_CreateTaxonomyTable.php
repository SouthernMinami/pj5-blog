<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateTaxonomyTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE taxonomies (
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                taxonomy_name VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL
            )
            DROP TABLE categories,
            DROP TABLE tags,
            DROP TABLE post_tags,
            "
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [
            "DROP TABLE taxonomies,
            CREATE TABLE categories (
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                category_name VARCHAR(255) NOT NULL
            ),
            CREATE TABLE tags (
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                tag_name VARCHAR(255) NOT NULL
            ),
            CREATE TABLE post_tags (
                post_id INT,
                tag_id BIGINT,
                PRIMARY KEY (post_id, tag_id),
                FOREIGN KEY (post_id) REFERENCES posts(id),
                FOREIGN KEY (tag_id) REFERENCES tags(id)
            )"
        ];
    }
}