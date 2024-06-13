<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TechnicalMaintenance>
 */
class TechnicalMaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'regulation_id' => 1,
            'equipment_id' => 1,
            'user_id' => 1,
            'equipment_accumulated_hours' => 150,
            'equipment_work_hours' => 8,
            'note' => 'Всё ок'
        ];
    }
}
