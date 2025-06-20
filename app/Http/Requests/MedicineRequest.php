<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description'          => 'required|string',
            'fantasy_name'         => 'required|string',
            'price'                => 'required|numeric|min:0',
            'type'                 => 'required',
            'form'                 => 'required',
            'dosage'               => 'required',
            'maker'                => 'required|string',
            'quantity'             => $this->isMethod('post') ? 'required|integer|min:1' : 'nullable',
            'image'                => $this->isMethod('post')
            ? 'required|image|mimes:jpeg,png,jpg,svg|max:3072'
            : 'nullable|image|mimes:jpeg,png,jpg,svg|max:3072',
            'active_ingredient_id' => 'required|exists:active_ingredients,id',

        ];
    }
    public function messages(): array
    {
        return [

            'description.required'          => 'O campo descrição é obrigatório!',
            'fantasy_name.required'         => 'O campo nome fantasia é obrigatório!',
            'price.required'                => 'O campo preço é obrigatório!',
            'price.numeric'                 => 'O preço deve ser um número válido!',
            'price.min'                     => 'O preço não pode ser negativo!',
            'type.required'                 => 'O campo tipo é obrigatório!',
            'form.required'                 => 'O campo forma é obrigatório!',
            'dosage.required'               => 'O campo dosagem é obrigatório!',
            'maker.required'                => 'O campo fabricante é obrigatório!',
            'quantity.required'             => 'O campo quantidade é obrigatório!',
            'quantity.integer'              => 'A quantidade deve ser um número inteiro!',
            'quantity.min'                  => 'A quantidade não pode ser menor que :min!',
            'image.required'                => 'A imagem do produto é obrigatória!',
            'image.image'                   => 'O arquivo deve ser uma imagem!',
            'image.mimes'                   => 'A imagem deve ser do tipo: jpeg, png, jpg ou svg!',
            'image.max'                     => 'O tamanho máximo da imagem é 3MB!',
            'active_ingredient_id.required' => 'O princípio ativo é obrigatório!',
            'active_ingredient_id.exists'   => 'O princípio ativo selecionado é inválido!',
        ];
    }
}
