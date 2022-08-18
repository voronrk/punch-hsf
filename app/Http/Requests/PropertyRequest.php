<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class PropertyRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $isAdmin = ($this->user()->roles->value == 'admin');
        $isUser = ($this->user()->id);
        if ($this->is('*.delete')) {
            return $isAdmin;
        } elseif ($this->is('*.update')) {
            return $isAdmin;
        } elseif ($this->is('*.add')) {
            return $isAdmin;
        } elseif ($this->is('*.get')) {
            return $isUser;
        } elseif ($this->is('*.list')) {
            return $isUser;
        } 
    }

    /**
     * Return message then error
     *
     * @param array $errors
     * @return void
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->first()], 422);
        throw new ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $value = 'required|max:64';
        $id = 'required|integer';

        if ($this->is('*.delete')) {
            return [
                'id' => $id,
            ];
        } elseif ($this->is('*.update')) {
            return [
                'value' => $value,
                'id' => $id,
            ];
        } elseif ($this->is('*.add')) {
            return [
                'value' => $value,
            ];
        } elseif ($this->is('*.get')) {
            return [
                'id' => $id,
            ];
        } else {
            return ['Wrong method!'];
        }
    }

    public function messages()
    {
        return [
            'value.required' => 'Необходимо указать значение',
            'value.max:64' => 'Длина названия должна быть не более 64 символов',
            'id.required' => 'Необходимо указать id элемента',
            'id.integer' => 'ID элемента должно быть целым числом',
        ];
    }
}
