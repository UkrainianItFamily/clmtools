<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiFormRequest;

final class UpdateValidationRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|min:2',
            'last_name' => 'string|min:2',
            'date_birth' => 'date|before:tomorrow|date_format:Y-m-d',
            'city' => 'integer',
            'university' => 'integer',
            'graduation_year' => 'integer|digits:4|min:1900|max:'.(date('Y')+1)
        ];
    }
}
