<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $names = ['Front-end', 'Back-end'];
        foreach ($names as $name) {
            $type = new Type();
            $type->name = $name;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
