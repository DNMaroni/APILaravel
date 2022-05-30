<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AtividadesUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data_inicio' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after:today', function ($attribute, $value, $fail) {
                if (Carbon::createFromTimeString($value)->isWeekend()) {
                    $fail('Não é possível adicionar atividades com datas em fim de semana');
                }
            }],
            'data_prazo' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after:today', 'after:data_inicio', function ($attribute, $value, $fail) {
                if (Carbon::createFromTimeString($value)->isWeekend()) {
                    $fail('Não é possível adicionar atividades com datas em fim de semana');
                }
            }],
            'data_conclusao' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after:today', 'after:data_inicio', function ($attribute, $value, $fail) {
                if (Carbon::createFromTimeString($value)->isWeekend()) {
                    $fail('Não é possível adicionar atividades com datas em fim de semana');
                }
            }],
            'status' => 'required|integer|lt:4',
            'titulo' => 'required|string|max:100',
            'descricao' => 'nullable|string|max:300',
            'responsavel_id' => 'required|exists:pessoas,id'
        ];
    }
}
