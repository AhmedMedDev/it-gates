<?php

declare(strict_types=1);

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'string',
            'notes' => 'string',
            'due_date' => 'date',
            'is_completed' => 'boolean',
        ];
    }
}
