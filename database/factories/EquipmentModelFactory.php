<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentModel>
 */
class EquipmentModelFactory extends Factory
{
    private static $number;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$number++;

        return [
            'name'=>'Тестовая модель #' . self::$number,
            'equipment_type_id'=>1
        ];
    }
}
