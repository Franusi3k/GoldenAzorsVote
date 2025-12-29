<?php

namespace App\Http\Requests;

use App\Domain\Poll\PollStatus;
use App\Domain\Poll\PollType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false; // admin lub właściciel głosowania
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'poll_type' => ['required', Rule::in(PollType::all())],
            'opens_at' => ['required', 'date', 'after_or_equal:now'],
            'closes_at' => ['nullable', 'date', 'after:opens_at'],
        ];
    }
}
