<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TechnicalMaintenanceConsumables>
 */
class TechnicalMaintenanceConsumableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'technical_maintenance_id' => 1,
            'material_id' => 1,
            'count' => 42
        ];
    }
}
