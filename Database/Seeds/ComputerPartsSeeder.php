<?php

namespace Database\Seeds;

require_once 'vendor/autoload.php';

use Database\AbstractSeeder;

class ComputerPartsSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'computer_parts';
    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'name'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'type'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'brand'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'model_number'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'release_date'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'description'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'performance_score'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'market_price'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'rsm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'power_consumptionw'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'lengthm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'widthm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'heightm'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'lifespan'
        ]
    ];

    public function createRowData(): array
    {
        return [
            [
                'Ryzen 9 5900X',
                'CPU',
                'AMD',
                '100-000000061',
                '2020-11-05',
                'A high-performance 12-core processor.',
                90,
                549.99,
                0.05,
                105.0,
                0.04,
                0.04,
                0.005,
                5
            ],
            [
                'GeForce RTX 3080',
                'GPU',
                'NVIDIA',
                '10G-P5-3897-KR',
                '2020-09-17',
                'A powerful gaming GPU with ray tracing support.',
                93,
                699.99,
                0.04,
                320.0,
                0.285,
                0.112,
                0.05,
                5
            ],
            [
                'Samsung 970 EVO SSD',
                'SSD',
                'Samsung',
                'MZ-V7E500BW',
                '2018-04-24',
                'A fast NVMe M.2 SSD with 500GB storage.',
                88,
                79.99,
                0.02,
                5.7,
                0.08,
                0.022,
                0.0023,
                5
            ],
            [
                'Corsair Vengeance LPX 16GB',
                'RAM',
                'Corsair',
                'CMK16GX4M2B3200C16',
                '2015-08-10',
                'A DDR4 memory kit operating at 3200MHz.',
                85,
                69.99,
                0.03,
                1.2,
                0.137,
                0.03,
                0.007,
                7
            ],
            [
                'ASUS ROG Strix B550-F',
                'Motherboard',
                'ASUS',
                '90MB14F0-M0EAY0',
                '2020-06-16',
                'A high-end motherboard with PCIe 4.0 support.',
                87,
                189.99,
                0.03,
                0.0,
                0.305,
                0.244,
                0.005,
                5
            ],
            [
                'EVGA SuperNOVA 750 G5',
                'PSU',
                'EVGA',
                '220-G5-0750-X1',
                '2019-06-05',
                'A 750W power supply with 80 Plus Gold certification.',
                90,
                129.99,
                0.03,
                750.0,
                0.15,
                0.15,
                0.085,
                7
            ],
            [
                'NZXT H510',
                'Case',
                'NZXT',
                'CA-H510B-W1',
                '2019-08-01',
                'A compact ATX case with a tempered glass side panel.',
                85,
                69.99,
                0.03,
                0.0,
                0.428,
                0.210,
                0.460,
                5
            ],
            // fakerのダミーデータを10000件生成
            ...array_map(function () {
                return [
                    \Faker\Factory::create()->name,
                    \Faker\Factory::create()->randomElement(['CPU', 'GPU', 'SSD', 'RAM', 'Motherboard', 'PSU', 'Case']),
                    \Faker\Factory::create()->company,
                    \Faker\Factory::create()->bothify('??????????'),
                    \Faker\Factory::create()->date,
                    \Faker\Factory::create()->text,
                    \Faker\Factory::create()->numberBetween(0, 100),
                    \Faker\Factory::create()->randomFloat(2, 0, 1000),
                    \Faker\Factory::create()->randomFloat(2, 0, 1),
                    \Faker\Factory::create()->randomFloat(2, 0, 1000),
                    \Faker\Factory::create()->randomFloat(2, 0, 10),
                    \Faker\Factory::create()->randomFloat(2, 0, 10),
                    \Faker\Factory::create()->randomFloat(2, 0, 10),
                    \Faker\Factory::create()->numberBetween(0, 10)
                ];

            }, range(0, 9999))
        ];
    }
}
