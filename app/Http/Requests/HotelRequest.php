<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            //
            'name' => 'required|string|unique:hotels,name,' . $this->route('hotel') . '|max:150',
            'address' => 'required|string|max:255',
            'city' => 'required|integer|exists:municipalities,id',
            'tax_id' => 'required|string|max:20|unique:hotels,tax_id,' . $this->route('hotel'),
            'max_rooms' => 'required|integer|min:1',
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre del hotel es obligatorio.',
            'name.unique' => 'El nombre del hotel ya está registrado.',
            'name.max' => 'El nombre del hotel no puede tener más de 150 caracteres.',
            'city.required' => 'La ciudad es obligatoria.',
            'city.integer' => 'El identificador de la ciudad debe ser un número.',
            'city.exists' => 'La ciudad seleccionada no es válida.',
            'tax_id.required' => 'El NIT del hotel es obligatorio.',
            'tax_id.unique' => 'El NIT del hotel ya está registrado.',
            'tax_id.max' => 'El NIT no puede tener más de 20 caracteres.',
        ];
    }
}
