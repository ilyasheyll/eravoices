<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'title' => ['required', 'max:45'],
            'min_descr' => ['required', 'max:150'],
            'event_id' => [
                'nullable',
//                Rule::requiredIf($this->image === null && $this->link === null),
                'numeric',
                'exists:events,id'
            ],
            'image' => [
                'nullable',
//                Rule::requiredIf($this->event_id === null),
                'image'
            ],
            'link' => [
                'nullable',
//                Rule::requiredIf($this->event_id === null),
                'url',
                'max:150'
            ],
            'active' => ['nullable', 'string'],
        ];
    }
}
