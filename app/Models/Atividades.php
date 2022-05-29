<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividades extends Model
{
    use HasFactory;

    protected $fillable = ['data_inicio', 'data_prazo', 'data_conclusao', 'status', 'titulo', 'descricao', 'responsavel_id'];

    public function pessoas()
    {
        return $this->hasOne(Pessoas::class, 'id', 'responsavel_id');
    }
}
