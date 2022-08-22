<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Tomador;
use \App\Models\Propuesta;
use \App\Models\Inspeccion;
use \illuminate\Support\Str;

class PropuestaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Propuesta $propuesta) {
            //
        })->afterCreating(function (Propuesta $propuesta) {

            Inspeccion::factory($propuesta->id);
            //
        });
    }

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'tomador_id' => Tomador::inRandomOrder()->first()->id,
            'numero_propuesta'=> $this->faker->bothify('0#:######'),
            'dominio' => Str::upper($this->faker->bothify('??###??')),
            'tipo' => $this->faker->randomElement(["Auto","Moto"]),
            'compania'=>$this->faker->randomElement(["Nacion","Vis Red","Colon","LPS"]),
            'estado' => $this->faker->randomElement(["enviado","pendiente","aceptado"]),
        ];


    }
}
