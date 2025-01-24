<?php

namespace App\Http\Requests;

use App\Models\Organizer;
use Illuminate\Foundation\Http\FormRequest;

class OrganizersRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'phone' => ['required', 'max:18'],
            'date_birth' => ['required', 'date'],
            'fiz_inn' => ['required_if:type,' . Organizer::FIZ_PERSON, 'nullable', 'size:10'],
            'name' => ['required_if:type,' . Organizer::UR_PERSON, 'max:100'],
            'ur_inn' => ['required_if:type,' . Organizer::UR_PERSON, 'nullable', 'size:12'],
            'ur_phone' => ['required_if:type,' . Organizer::UR_PERSON, 'max:18'],
            'email' => ['required_if:type,' . Organizer::UR_PERSON, 'max:255'],
            'mailing_address' => ['required_if:type,' . Organizer::UR_PERSON, 'max:100'],
            'legal_address' => ['required_if:type,' . Organizer::UR_PERSON, 'max:100'],
        ];
    }
}
