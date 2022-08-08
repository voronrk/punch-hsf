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
        return true;
    }

    /**
     * Undocumented function
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
        return [
            'title' => 'required',
            'size-length' => 'required|numeric',
            'size-width' => 'required|numeric',
            'size-height' => '',
            'knife-size-length' => 'required|numeric',
            'knife-size-width' => 'required|numeric',
            'products' => 'required',
            'machines' => 'required',
            'materials' => 'required',
            'year' => "integer|between:2000,{$this->currentYear}",
            'ordernum' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Не указано название',
            'products.required' => 'Не указан продукт',
            'materials.required' => 'Не указан материал',
            'machines.required' => 'Не указана машина',            
            'size-length.required' => 'Не указана длина изделия',
            'size-width.required' => 'Не указана ширина изделия',
            'knife-size-length.required' => 'Не указана длина по ножам',
            'knife-size-width.required' => 'Не указана ширина по ножам',
            'subject.numeric' => 'Поле должно содержать число',
            'year.integer' => 'Год должен быть целым числом',
            "year.between" => "Год должен быть в диапазоне от 2000 до {$this->currentYear}",
        ];
    }
}
