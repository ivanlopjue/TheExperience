<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=> $this->faker->text(50),
            'mail'=> $this->faker->text(100),
            'telefono'=> $this->faker->phoneNumber,
            'hora' => $this->faker->randomElement(['13:30', '14:30', '20:00', '21:00']),
            'turno' => $this->faker->randomElement(['comida','cena']),
            'fecha' => $this->faker->dateTimeBetween('now', '+20 week'),
            'comensales' => $this->faker->numberBetween(1,10),
            'observaciones' => $this->faker->optional->sentence(1),
            'localizador' => $this->faker->numberBetween(1250,9999),
            'id_usuario' => Usuario::inRandomOrder()->first()->id,
        ];
    }
}
