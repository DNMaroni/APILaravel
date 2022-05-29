<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadesByrangeRequest extends FormRequest
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
            'data_inicio' => 'required|date|date_format:Y-m-d H:i:s',
            'data_fim' => 'required|date|date_format:Y-m-d H:i:s|after:data_inicio',
        ];
    }
}
