<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class FavoriteRequest extends FormRequest
{
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $punch_id = 'required|integer|exists:punches,id';

        if ($this->is('*.delete')) {
            return [
                'punch_id' => $punch_id,
            ];
        } elseif ($this->is('*.add')) {
            return [
                'punch_id' => $punch_id,
            ];
        } else {
            return ['Wrong method!'];
        }
    }

    public function messages()
    {
        return [
            'punch_id.required' => 'Необходимо указать id штампа',
            'punch_id.integer' => 'ID штампа должно быть целым числом',
            'punch_id.exists' => 'Штампа нет в каталоге',
        ];
    }
}
