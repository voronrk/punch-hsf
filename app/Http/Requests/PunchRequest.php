<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class PunchRequest extends FormRequest
{

    protected $currentYear;

    public function __construct()
    {
        $this->currentYear = date("Y");
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $isAdmin = ($this->user()->roles->value == 'admin');
        if ($this->is('*.delete')) {
            return $isAdmin;
        } elseif ($this->is('*.update')) {
            return $isAdmin;
        } elseif ($this->is('*.add')) {
            return $isAdmin;
        } elseif ($this->is('*.get')) {
            return true;
        } elseif ($this->is('*.list')) {
            return true;
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
        $response = new Response(['error' => $validator->errors()->all()], 422);
        throw new ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
{
        $rules = [
            'id' => 'required|integer',
            'name' => 'required',
            'size-length' => 'required|numeric',
            'size-width' => 'required|numeric',
            'size-height' => 'nullable|numeric',
            'knife-size-length' => 'required|numeric',
            'knife-size-width' => 'required|numeric',
            'products' => 'required|array',
            'machines' => 'required|array',
            'materials' => 'required|array',
            'year' => "integer|between:2000,{$this->currentYear}",
            'ordernum' => '',
        ];
        if ($this->is('*.delete')) {
            return [
                'id' => $rules['id'],
            ];
        } elseif ($this->is('*.update')) {
            $result = [];
            foreach($this->keys() as $key) {
                $result[$key] = $rules[$key];
            };
            return $result;
        } elseif ($this->is('*.add')) {
            unset($rules['id']);
            return $rules;
        } elseif ($this->is('*.get')) {
            return [
                'id' => $rules['id'],
            ];
        } else {
            return ['Wrong method!'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан id элемента',
            'title.required' => 'Не указано название',
            'products.required' => 'Не указан продукт',
            'materials.required' => 'Не указан материал',
            'machines.required' => 'Не указана машина',            
            'size-length.required' => 'Не указана длина изделия',
            'size-width.required' => 'Не указана ширина изделия',
            'size-length.numeric' => 'Длина изделия должна быть числом',
            'size-width.numeric' => 'Ширина изделия должна быть числом',
            'size-height.numeric' => 'Высота изделия должна быть числом',
            'knife-size-length.required' => 'Не указана длина по ножам',
            'knife-size-width.required' => 'Не указана ширина по ножам',
            'knife-size-length.numeric' => 'Длина по ножам должна быть числом',
            'knife-size-width.numeric' => 'Ширина по ножам должна быть числом',
            'year.integer' => 'Год должен быть целым числом',
            "year.between" => "Год должен быть в диапазоне от 2000 до {$this->currentYear}",
        ];
    }
}
