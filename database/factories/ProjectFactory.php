<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    private static $projectNumber = 1;

    public function definition(): array
    {
        $name = 'Проект #' . self::$projectNumber;

        self::$projectNumber++; // Увеличиваем номер для следующего проекта

        return [
            'name' => $name,
            'status' => 1,
        ];
    }
}
