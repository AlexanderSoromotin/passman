<?php

namespace Database\Factories;

use App\Models\Counter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CounterReading>
 */
class CounterReadingFactory extends Factory
{
    private static $readingsNumber = 1;
    private static $counterId = 0;
    private static $value = 0;


    public function definition(): array
    {
//        if (self::$readingsNumber >= 6) {
//
//            self::$readingsNumber = 1;
//        }

        self::$counterId++;
        self::$value = 0;
        $counterData = Counter::with('equipment.project')->find(self::$counterId);

        self::$value += rand(10, 50) + rand(1, 10) / 10;

        self::$readingsNumber++;

        return [
            'project_id' => $counterData->equipment->project->id,
            'equipment_id' => $counterData->equipment->id,
            'counter_id' => self::$counterId,
            'user_id' => 10,
            'value' => self::$value,
        ];
    }
}
