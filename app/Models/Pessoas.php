<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'telefone', 'email'];

    public function atividades()
    {
        return $this->belongsTo(Atividades::class);
    }
}
