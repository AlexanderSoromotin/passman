<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    private static $i = 1;
    private static $equipmentNumber = 1;
    private static $projectNumber = 1;

    public function definition(): array
    {
        $name = 'РСУ #' . self::$i;

        if (self::$equipmentNumber > 3) {
            self::$projectNumber++;
            self::$equipmentNumber = 1;
        }

        self::$i++;
        self::$equipmentNumber++; // Увеличиваем номер для следующего проекта

        return [
            'code' => $name,
            'project_id' => self::$projectNumber,
            'equipment_model_id' => 1,
            'status' => 'working',
        ];
    }
}
