<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data_inicio', $precision = 0);
            $table->timestamp('data_prazo', $precision = 0);
            $table->timestamp('data_conclusao', $precision = 0);
            $table->smallInteger('status')->comment('1: Aguardando, 2: Realizado, 3: Não realizado');
            $table->string('titulo', 100);
            $table->text('descricao', 300)->nullable();
            $table->unsignedBigInteger('responsavel_id');
            $table->foreign('responsavel_id')->references('id')->on('pessoas')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
};
