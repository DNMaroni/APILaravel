<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use database\factories\UserFactory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pessoas;
use App\Models\Atividades;
use Illuminate\Support\Facades\Artisan;

class TaskApiTest extends TestCase
{
    /* use RefreshDatabase; */


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_atividade()
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Pessoas::factory(10)->create();
        Atividades::factory(10)->create();

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $formData = [
            'titulo' => 'teste titulo',
            'descricao' => 'teste descricao',
            'data_inicio' => '2022-08-16 18:21:53',
            'data_prazo' => '2022-08-18 18:21:53',
            'data_conclusao' => '2022-08-18 18:21:53',
            'responsavel_id' => '1',
            'status' => 1
        ];

        $this->withoutExceptionHandling();

        $this->json('POST', route('atividades.store'), $formData)
            ->assertStatus(201);
    }

    public function test_can_show_atividade()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->json('GET', '/api/atividades/1')->assertStatus(200);
    }

    public function test_can_show_all_atividades()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->json('GET', '/api/atividades')->assertStatus(200);
    }

    public function test_can_update_atividade()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $formData = [
            'titulo' => 'teste titulo update',
            'descricao' => 'teste descricao update',
            'data_inicio' => '2022-09-28 18:21:53',
            'data_prazo' => '2022-09-29 18:21:53',
            'data_conclusao' => '2022-09-29 18:21:53',
            'responsavel_id' => '2',
            'status' => 1
        ];

        $this->withoutExceptionHandling();

        $this->json('PUT', '/api/atividades/1', $formData)
            ->assertStatus(200);
    }

    public function test_can_delete_atividade()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $this->withoutExceptionHandling();

        $this->json('DELETE', '/api/atividades/1')
            ->assertStatus(200);
    }

    public function test_can_show_range_atividade()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $formData = [
            'data_inicio' => '2022-05-28 18:21:53',
            'data_fim' => '2022-07-29 18:21:53'
        ];

        $this->withoutExceptionHandling();

        $this->json('POST', '/api/atividades/byrange', $formData)
            ->assertStatus(200);
    }
}
