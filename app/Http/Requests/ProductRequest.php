<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'species_id'   => 'required|exists:species,id',
            'name'         => 'required|string|max:255',
            'shape'        => 'required|string|max:255',
            'weight'       => 'required|string|max:255',
            'type'         => 'required|string|max:255',
            'maker'        => 'required|string|max:255',
            'code_product' => 'required|string|max:255|unique:products,code_product,' . $this->id,
            'price'        => 'required|numeric|min:0',
            'quantity'     => $this->isMethod('post') 
                ? 'required|integer|min:1' 
                : 'nullable|integer|min:1',

            // imagem obrigatória apenas no create
            'image'        => $this->isMethod('post')
                ? 'required|image|mimes:jpeg,png,jpg,svg|max:3072'
                : 'nullable|image|mimes:jpeg,png,jpg,svg|max:3072',
        ];
    }

    public function messages(): array
    {
        return [
            'species_id.required'   => 'A espécie é obrigatória.',
            'species_id.exists'     => 'A espécie selecionada é inválida.',

            'name.required'         => 'O nome do produto é obrigatório.',
            'shape.required'        => 'O formato é obrigatório.',
            'weight.required'       => 'O peso/volume é obrigatório.',
            'type.required'         => 'O tipo do produto é obrigatório.',
            'maker.required'        => 'O fabricante é obrigatório.',

            'code_product.required' => 'O código do produto é obrigatório.',
            'code_product.unique'   => 'Este código já está cadastrado.',

            'price.required'        => 'O preço é obrigatório.',
            'price.numeric'         => 'O preço deve ser numérico.',
            'price.min'             => 'O preço não pode ser negativo.',

            'quantity.required'     => 'A quantidade é obrigatória.',
            'quantity.integer'      => 'A quantidade deve ser um número inteiro.',
            'quantity.min'          => 'A quantidade mínima é 1.',

            'image.required'        => 'A imagem do produto é obrigatória.',
            'image.image'           => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes'           => 'A imagem deve ser JPEG, PNG, JPG ou SVG.',
            'image.max'             => 'A imagem deve ter no máximo 3MB.',
        ];
    }
}
