<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'price' => fake()->numberBetween(1000, 100000000),
            'course_id' => resolve(CourseRepositoryInterface::class)->getRandom()->id,
        ];
    }
}
