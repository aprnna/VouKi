<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            // 'location' => ['required', 'string'],
            'max_volunteers' => ['required', 'integer'],
            'category' => ['required', 'string', 'in:music,sport,education,technology,art,fashion,food,other'],
            'prefered_skills' => ['required', 'string', 'in:it,design,marketing,finance,comunication,leader,other'],
            'RegisterStart' => ['required', 'date'],
            'RegisterEnd' => ['required', 'date'],
            'EventStart' => ['required', 'date'],
            'EventEnd' => ['required', 'date'],
            'banner' =>  ['image', 'mimes:png,jpg,jpeg,gif, svg', 'max:2048'],
        ];
    }
}
