<?php

namespace App\Http\Requests\Event;
use App\Models\EventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'descr' => ['required', 'string'],
            'organizer_id' => ['nullable', 'numeric', 'exists:organizers,id'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'date' => ['required', 'date_format:Y-m-d'],
            'time' => ['required', 'date_format:"H:i"'],
            'image' => ['image'],
            'prices' => ['required', 'array' ],
            'prices.*' => ['required', 'array', 'min:2'],
            'prices.*.zone_id' => ['required', 'numeric', 'exists:zones,id'],
            'prices.*.price_value' => ['required', 'numeric'],
            'event_status_id' => ['numeric', 'exists:event_statuses,id'],
            'percent' => [
                'nullable',
                Rule::requiredIf($this->organizer_id != null && (int)$this->event_status_id === EventStatus::ACTIVE_STATUS),
                'numeric',
                'max:100'
            ],
        ];
    }
}
