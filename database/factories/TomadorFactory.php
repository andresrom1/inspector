<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \illuminate\Support\Str;

class TomadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::upper($this->faker->name),
            'email'=> $this->faker->email

        ];
    }
    //Tomador::factory()->count(50)->create() <--- Tinker command
}
