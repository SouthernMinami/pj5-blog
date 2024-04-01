<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateTaxonomyTermTable implements SchemaMigration
{
    public function up(): array
    {
        // マイグレーション処理を書く
        return [
            "CREATE TABLE traxonomy_terms(
                id BIGINT PRIMARY KEY AUTO_INCREMENT,
                taxonomy_type_id BIGINT,
                term_type_name VARCHAR(255) NOT NULL,
                FOREIGN KEY (taxonomy_type_id) REFERENCES taxonomies(id) ON DELETE CASCADE,
                description VARCHAR(255) NOT NULL
            )"
        ];
    }

    public function down(): array
    {
        // ロールバック処理を書く
        return [];
    }
}