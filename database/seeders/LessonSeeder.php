<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Repositories\Lesson\LessonRepositoryInterface;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessonRepository = resolve(LessonRepositoryInterface::class);

        if (! $lessonRepository->getCount()) {
            Lesson::factory(10)->create();
        } else {
            $this->command->warn('Lessons has already been created');
        }
    }
}
