<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* GERAR PESSOAS */
        \App\Models\Pessoas::factory(10)->create();

        /* GERAR ATIVIDADES */
        \App\Models\Atividades::factory(10)->create();
    }
}
