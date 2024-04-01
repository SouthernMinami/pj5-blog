<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreatePostTaxonomyTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE post_taxonomies(
                id BIGINT,
                post_id INT,
                taxonomy_id BIGINT,
                PRIMARY KEY (post_id, taxonomy_id),
                FOREIGN KEY (post_id) REFERENCES posts(id),
                FOREIGN KEY (taxonomy_id) REFERENCES taxonomies(id)
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [];
    }
}