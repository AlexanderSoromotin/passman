<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Counter>
 */
class CounterFactory extends Factory
{
    private static $counterNumber = 0;
    private static $i = 0;
    private static $equipmentNumber = 0;

    public function definition(): array
    {
/*        if (self::$counterNumber >= 3) {
            self::$counterNumber = 0;
        }
        self::$counterNumber++;*/

        self::$equipmentNumber++;
        self::$i++;


        $name = 'Счётчик #' . self::$i;

        return [
            'name' => $name,
            'equipment_id' =>  self::$equipmentNumber,
            'counter_type_id' => 4,
            'status' => 1,
        ];
    }
}
