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
            'id.required' => '???? ???????????? id ????????????????',
            'title.required' => '???? ?????????????? ????????????????',
            'products.required' => '???? ???????????? ??????????????',
            'materials.required' => '???? ???????????? ????????????????',
            'machines.required' => '???? ?????????????? ????????????',            
            'size-length.required' => '???? ?????????????? ?????????? ??????????????',
            'size-width.required' => '???? ?????????????? ???????????? ??????????????',
            'size-length.numeric' => '?????????? ?????????????? ???????????? ???????? ????????????',
            'size-width.numeric' => '???????????? ?????????????? ???????????? ???????? ????????????',
            'size-height.numeric' => '???????????? ?????????????? ???????????? ???????? ????????????',
            'knife-size-length.required' => '???? ?????????????? ?????????? ???? ??????????',
            'knife-size-width.required' => '???? ?????????????? ???????????? ???? ??????????',
            'knife-size-length.numeric' => '?????????? ???? ?????????? ???????????? ???????? ????????????',
            'knife-size-width.numeric' => '???????????? ???? ?????????? ???????????? ???????? ????????????',
            'year.integer' => '?????? ???????????? ???????? ?????????? ????????????',
            "year.between" => "?????? ???????????? ???????? ?? ?????????????????? ???? 2000 ???? {$this->currentYear}",
        ];
    }
}
