<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'tickets' => ['required', 'array'],
            'tickets.*.seatId' => ['required', 'numeric', 'exists:seats,id'],
            'tickets.*.priceId' => ['required', 'numeric', 'exists:prices,id'],
            'tickets.*.priceValue' => ['required', 'numeric'],
        ];
    }
}
