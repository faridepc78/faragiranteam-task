<?php

use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\LessonController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->name('api.v1.')
    ->as('api.v1.')
    ->middleware(['api', 'throttle:50,1'])
    ->group(function () {

        // #region Course
        Route::put(
            'courses/{course}',
            [CourseController::class, 'update']
        )
            ->name('courses.update');
        // #endregion

        // #region Lesson
        Route::post(
            'lessons',
            [LessonController::class, 'store']
        )
            ->name('lessons.store');
        // #endregion
    });
