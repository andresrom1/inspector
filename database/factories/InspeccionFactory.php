<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Propuesta;




class InspeccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propuesta_id' => Propuesta::factory()
        ];
    }
}

//Inspeccion::factory()->count(1)->create() 
