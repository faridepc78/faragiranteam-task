<?php

namespace App\Http\Requests\Api\V1\Lesson;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $course_id = request()->input('course_id');

        return [
            'course_id' => ['required', 'exists:courses,id'],
            'name' => ['required', 'string', 'max:255',
                Rule::unique('lessons', 'name')
                    ->where(function (Builder $query) use ($course_id) {
                        $query->where('course_id', '=', $course_id);
                    }),
            ],
            'price' => ['required', 'numeric', 'min:1000', 'max:100000000'],
        ];
    }
}
