<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Course\UpdateCourseRequest;
use App\Http\Resources\Api\V1\Course\CourseResource;
use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;

class CourseController extends Controller
{
    protected CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        $this->courseRepository->update($request->validated(), $course->id);

        return $this->success_response(
            CourseResource::make($this->courseRepository
                ->loadRelationsByModel($course->refresh(), ['lessons'])),
            'the course has been successfully update'
        );
    }
}
