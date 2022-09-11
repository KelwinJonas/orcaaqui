<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:300'],
            'valor' => ['required', 'numeric', 'min:0.01'],
            'quantidade' => ['required', 'numeric', 'min:1'],
            'descricao' => ['required', 'string', 'max:20000'],
            'categoria' => ['required', 'numeric'],
        ];
    }

    /**
     * Get custom attributes for validator errors..
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'descricao' => 'descrição',
        ];
    }
}
