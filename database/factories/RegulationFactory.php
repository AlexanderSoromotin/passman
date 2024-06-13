<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regulation>
 */
class RegulationFactory extends Factory
{
    private static $equipmentModelId = 0;
    private static $frequency = -250;
    private static $is_daily = true;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //self::$equipmentModelId++;
        self::$frequency = self::$frequency+250;
        if (self::$frequency > 0)
        {
            self::$is_daily = false;
        }
        if (self::$frequency == 750)
            self::$frequency = 1000;

        if (self::$frequency == 1250)
            self::$frequency = 2000;

        return [
            'equipment_model_id' => 1,
            'name' => 'Тестовый регламент на ' . self::$frequency. ' часов',
            'content' => '1. Проверить масло. '."\n".'2. Проверить заряд.',
            'frequency' => self::$frequency,
            'is_daily' => self::$is_daily
        ];


    }
}
