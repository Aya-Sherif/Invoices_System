<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'الاسم' => [
                'required',
                'min:3',
                'max:100',
                'unique:clients,name'
            ],
            'رقم_الهاتف' => [
                'required',
                'regex:/^(011|010|012|015)\d{8}$/'
            ],
        ];
    }
}
