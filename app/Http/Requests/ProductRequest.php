<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => 'required|max:30|unique:products',
            'name' => 'required|max:255',
            'description' => 'nullable|max:20000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|numeric|gt:0'
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'SKU é obrigatório',
            'sku.max' => 'O limite de caracteres do SKU é 30',
            'sku.unique' => 'Já existe um produto com esse SKU',
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O limite de caracteres do nome é de 255',
            'description.max' => 'O limite de caracteres da descrição é de 20000',
            'price.required' => 'O preço é obrigatório',
            'price.regex' => 'Preço inválido',
            'stock.required' => 'O estoque é obrigatório',
            'stock.numeric' => 'Somente números',
            'stock.gt' => 'O estoque não pode ser negativo'
        ];
    }
}
