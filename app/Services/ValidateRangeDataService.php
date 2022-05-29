<?php

namespace App\Services;

/* use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider; */
use Illuminate\Http\Request;
use App\Http\Requests\AtividadesStoreRequest;
use App\Models\Atividades;

class ValidateRangeDataService
{
    /**
     * start
     *
     * @param  mixed $request
     * @return void
     */
    public function validate(Request $request)
    {
        return Atividades::where('responsavel_id', '=', $request->get('responsavel_id'))->where('data_inicio', '<=', $request->get('data_inicio'))->where('data_conclusao', '>=', $request->get('data_inicio'))
        ->orWhere(function ($query) use ($request) {
            $query->where('data_inicio', '<=', $request->get('data_conclusao'))
                  ->where('data_conclusao', '>=', $request->get('data_conclusao'));
        })->get();
    }
}
