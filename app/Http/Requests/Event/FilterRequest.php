<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'name' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'event_status_id' => 'nullable|numeric|exists:event_statuses,id',
        ];
    }
}
