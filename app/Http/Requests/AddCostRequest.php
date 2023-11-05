<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'wallets' => 'required',
            'categories' => 'required',
            'value' => 'required|numeric',
            'comment' => 'string|nullable',
        ];
    }
}
