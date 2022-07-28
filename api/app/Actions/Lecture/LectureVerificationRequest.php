<?php

declare(strict_types=1);

namespace App\Actions\Lecture;

use App\Http\Requests\Api\ApiFormRequest;

final class LectureVerificationRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'link' => 'required',
            'course_id' => 'required|numeric',
            'user_id' => 'required|array',
        ];
    }
}
