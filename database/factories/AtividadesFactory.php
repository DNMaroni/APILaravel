<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atividades>
 */
class AtividadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'responsavel_id' => $this->faker->randomDigitNot(0),
            'data_inicio' => $this->faker->dateTimeBetween('-30 years', 'now'),
            'data_prazo' => $this->faker->dateTimeBetween('-30 years', 'now'),
            'data_conclusao' => $this->faker->dateTimeBetween('-30 years', '+5 years'),
            'status' => 1,
            'titulo' => $this->faker->sentence,
            'descricao' => $this->faker->text
        ];
    }
}
