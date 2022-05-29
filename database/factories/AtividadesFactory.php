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
            'data_inicio' => $this->faker->dateTimeBetween('now', '+5 days'),
            'data_prazo' => $this->faker->dateTimeBetween('+5 days', '+10 days'),
            'data_conclusao' => $this->faker->dateTimeBetween('+5 days', '+10 days'),
            'status' => 1,
            'titulo' => $this->faker->sentence,
            'descricao' => $this->faker->text
        ];
    }
}
