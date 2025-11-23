<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pet_name'     => 'required|string|max:255',
            'owner_phone'  => 'required|string|max:20',
            'date'         => 'required|date|after_or_equal:today',
            'time'         => 'required',
            
            // serviços chega como array de checkboxes
            'services'     => 'required|array|min:1',

            // valores vêm calculados no frontend, mas validamos mesmo assim
            'total_value'  => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'pet_name.required'    => 'O nome do pet é obrigatório.',
            'owner_phone.required' => 'O telefone do proprietário é obrigatório.',
            'date.required'        => 'A data do agendamento é obrigatória.',
            'date.after_or_equal'  => 'A data não pode ser no passado.',
            'time.required'        => 'O horário é obrigatório.',
            'services.required'    => 'Selecione pelo menos um serviço.',
            'services.array'       => 'Formato inválido de serviços.',
            'services.min'         => 'Escolha pelo menos um serviço.',
            'total_value.required' => 'O valor total é obrigatório.',
        ];
    }
}

