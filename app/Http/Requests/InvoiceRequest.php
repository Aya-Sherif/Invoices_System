<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'العميل' => 'required|exists:clients,id',
            'البند' => 'required|array|min:1',
            'البند.*' => '',
            'الكميه' => 'required|array|min:1',
            'الكميه.*' => '',
            'price' => '',
            'price.*' => '',
            'discount' => '',
            'discount.*' => '',
            'price_after_discount' => '',
            'price_after_discount.*' => '',
            'total-before-discount' => '',
            "total-after-discount" => '',

        ];
    }
}
