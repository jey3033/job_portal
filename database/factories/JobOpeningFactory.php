<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobOpeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(4),
            'qualification' => $this->faker->sentence(),
            'author' => 1,
            'active' => random_int(0,2),
            'job_path' => $this->faker->uuid()
        ];
    }
}
