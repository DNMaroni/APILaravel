<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoas>
 */
class PessoasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

   
    public function definition()
    {
        /* $faker = Faker\Factory::create(); */
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'telefone' => $this->faker->numerify('###########')
        ];
    }
}
