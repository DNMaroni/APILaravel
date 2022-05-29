<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividades;
use App\Http\Requests\AtividadesStoreRequest;
use App\Http\Requests\AtividadesByrangeRequest;
use App\Http\Requests\AtividadesUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\ValidateRangeDataService;

class AtividadesController extends Controller
{
    private ValidateRangeDataService $validaterange;
    
    public function __construct(ValidateRangeDataService $validaterange)
    {
        $this->validaterange = $validaterange;
        $this->middleware('auth:api');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return Atividades::with('pessoas')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(AtividadesStoreRequest $request)
    {
        $request->validated();
        
        $busca_atividade = $this->validaterange->validate($request);

        //se a data do request for encontrada entre alguma atividade do mesmo responsavel, não deixa criar
        if ($busca_atividade->count() > 0) {
            return response()->json(['message' => 'Ops, uma atividade deste responsável já existe entre as datas de inicio e conclusão.'], 200);
        }
        
        return Atividades::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Atividades $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $atividade = Atividades::with('pessoas')->findOrFail(last($request->segments()));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Não encontrado!'], 404);
        }

        return $atividade;
    }
    
    /**
     * byRange
     *
     * @param  mixed $request
     * @return void
     */
    public function byRange(AtividadesByrangeRequest $request)
    {
        $request->validated();

        return Atividades::with('pessoas')->whereBetween('data_inicio', [
            $request->get('data_inicio'),
            $request->get('data_fim')
        ])->get();
    }

    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(AtividadesUpdateRequest $request, $id)
    {
        $request->validated();

        $busca_atividade = $this->validaterange->validate($request);

        //se a data do request for encontrada entre alguma atividade do mesmo responsavel, não deixa criar
        if ($busca_atividade->count() > 0 and $busca_atividade->first()->responsavel_id != $request->get('responsavel_id')) {
            return response()->json(['message' => 'Ops, uma atividade deste responsável já existe entre as datas de inicio e conclusão.'], 200);
        }
        
        try {
            $atividade = Atividades::with('pessoas')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Não encontrado'], 404);
        }

        return tap($atividade)->update($request->all());
    }

       
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $atividade = Atividades::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Não encontrado'], 404);
        }

        return Atividades::destroy($id) == 1 ? response()->json(['message' => 'Removido com sucesso'], 200) : response()->json(['message' => 'Não encontrado'], 400);
    }
}
