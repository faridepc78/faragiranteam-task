<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Lesson\StoreLessonRequest;
use App\Http\Resources\Api\V1\Lesson\LessonResource;
use App\Repositories\Lesson\LessonRepositoryInterface;

class LessonController extends Controller
{
    protected LessonRepositoryInterface $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = $this->lessonRepository->create($request->validated());

        return $this->success_response(
            LessonResource::make($this->lessonRepository
                ->loadRelationsByModel($lesson, ['course'])),
            'the lesson has been successfully created'
        );
    }
}
