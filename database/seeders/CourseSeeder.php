<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courseRepository = resolve(CourseRepositoryInterface::class);

        if (! $courseRepository->getCount()) {
            Course::factory(10)->create();
        } else {
            $this->command->warn('Courses has already been created');
        }
    }
}
