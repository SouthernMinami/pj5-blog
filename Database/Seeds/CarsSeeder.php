<?php

namespace Database\Seeds;

use Database\AbstractSeeder;

require_once 'vendor/autoload.php';

class CarsSeeder extends AbstractSeeder
{

    protected ?string $tableName = 'cars';

    protected array $tableColumns = [
        [
            "data_type" => "string",
            "column_name" => "make"
        ],
        [
            "data_type" => "string",
            "column_name" => "model"
        ],
        [
            "data_type" => "int",
            "column_name" => "year"
        ],
        [
            "data_type" => "string",
            "column_name" => "color"
        ],
        [
            "data_type" => "float",
            "column_name" => "price"
        ],
        [
            "data_type" => "float",
            "column_name" => "mileage"
        ],
        [
            "data_type" => "string",
            "column_name" => "transmission"
        ],
        [
            "data_type" => "string",
            "column_name" => "engine"
        ],
        [
            "data_type" => "string",
            "column_name" => "status"
        ]
    ];

    public function createRowData(): array
    {
        return [
            ...array_map(function () {
                $makers = ['Toyota', 'Honda', 'Nissan', 'Mitsubishi', 'Subaru'];
                $models_map = [
                    'Toyota' => ['Prius', 'Corolla', 'Camry', 'RAV4', 'Highlander'],
                    'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey'],
                    'Nissan' => ['Sentra', 'Altima', 'Maxima', 'Rogue', 'Pathfinder'],
                    'Mitsubishi' => ['Mirage', 'Lancer', 'Outlander', 'Eclipse Cross', 'Pajero'],
                    'Subaru' => ['Impreza', 'Legacy', 'Forester', 'Outback', 'Ascent']
                ];

                return [
                    \Faker\Factory::create()->randomElement($makers),
                    \Faker\Factory::create()->randomElement($models_map[$makers[0]]),
                    (int) \Faker\Factory::create()->year(),
                    \Faker\Factory::create()->colorName(),
                    \Faker\Factory::create()->randomFloat(2, 10000, 50000),
                    \Faker\Factory::create()->randomFloat(2, 0, 200000),
                    \Faker\Factory::create()->randomElement(['Automatic', 'Manual']),
                    \Faker\Factory::create()->randomElement(['V6', 'V8', 'V12']),
                    \Faker\Factory::create()->randomElement(['New', 'Used'])
                ];
            }, range(0, 999))
        ];
    }
}
