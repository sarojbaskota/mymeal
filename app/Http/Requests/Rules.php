<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rules extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'regex:/^[a-zA-Z ]+$/u|unique:meals,title|required|string',
        ];
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return response()->json([
        //            'errors' => $validator->errors()->all()
        //         ]);
    }
}
