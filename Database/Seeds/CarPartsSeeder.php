<?php

namespace Database\Seeds;

require_once 'vendor/autoload.php';

use Database\AbstractSeeder;

class CarPartsSeeder extends AbstractSeeder
{

    protected ?string $tableName = 'car_parts';

    protected array $tableColumns = [
        [
            'data_type' => 'int',
            'column_name' => 'car_id'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'name'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'description'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'price'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'quantity_in_stock'
        ]
    ];

    public function createRowData(): array
    {
        return [
            ...array_map(function () {
                $parts = ['Tires', 'Suspension', 'Brakes', 'Wheels', 'Exhaust'];
                $descriptions_map = [
                    'Suspension' => 'A system of springs, shock absorbers, and linkages that connect a vehicle to its wheels',
                    'Brakes' => 'A device for slowing or stopping a moving vehicle, typically by applying pressure to the wheels',
                    'Tires' => 'A rubber covering, typically inflated or surrounding an inflated inner tube, placed around a wheel to form a flexible contact with the road',
                    'Wheels' => 'A circular object that revolves on an axle and is fixed below a vehicle or other object to enable it to move easily over the ground',
                    'Exhaust' => 'A pipe or duct that carries away waste gases and air from a combustion engine'
                ];
                $max_car_id = 100;

                return [
                    rand(1, $max_car_id),
                    \Faker\Factory::create()->randomElement($parts),
                    \Faker\Factory::create()->randomElement($descriptions_map),
                    \Faker\Factory::create()->randomFloat(2, 100, 1000),
                    \Faker\Factory::create()->randomNumber(2)
                ];
            }, range(0, 9999))
        ];
    }
}