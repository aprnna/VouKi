<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'max_volunteers' => ['required', 'integer'],
            'categories' => ['required'],
            'skills' => ['required'],
            'RegisterStart' => ['required', 'date'],
            'RegisterEnd' => ['required', 'date'],
            'EventStart' => ['required', 'date'],
            'EventEnd' => ['required', 'date'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'city' => ['required', 'string'],
            'province' => ['required', 'string'],
            'country' => ['required', 'string'],
            'banner' => ['required', 'image', 'mimes:png,jpg,jpeg,gif, svg', 'max:2048'],
        ];
    }
}
