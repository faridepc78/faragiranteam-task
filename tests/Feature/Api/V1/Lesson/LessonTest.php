<?php

namespace Api\V1\Lesson;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_not_store_lesson_without_course_id()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'name' => 'test',
            'price' => 1000,
        ])->assertStatus(422);
    }

    public function test_user_can_not_store_lesson_by_invalid_course_id()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => 100,
            'name' => 'test',
            'price' => 1000,
        ])->assertStatus(422);
    }

    public function test_user_can_not_store_lesson_without_name()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => $this->createCourse()->id,
            'price' => 1000,
        ])->assertStatus(422);
    }

    public function test_user_can_not_store_lesson_with_duplicate_name()
    {
        $course = $this->createCourse();

        $lesson = Lesson::query()
            ->create([
                'course_id' => $course->id,
                'name' => 'test',
                'price' => 1000,
            ]);

        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => $course->id,
            'name' => $lesson->name,
            'price' => 1000,
        ])->assertStatus(422);
    }

    public function test_user_can_not_store_lesson_without_price()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => $this->createCourse()->id,
            'name' => 'test',
        ])->assertStatus(422);
    }

    public function test_user_can_not_store_lesson_with_wrong_price()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => $this->createCourse()->id,
            'name' => 'test',
            'price' => 'test',
        ])->assertStatus(422);
    }

    public function test_user_can_store_lesson()
    {
        $this->postJson(route('api.v1.lessons.store'), [
            'course_id' => $this->createCourse()->id,
            'name' => 'test',
            'price' => 1000,
        ])->assertSuccessful()
            ->assertStatus(201);

        $this->assertEquals(1, Lesson::count());
    }

    private function createCourse()
    {
        return Course::factory()->create();
    }

    private function createLesson()
    {
        $this->createCourse();

        return Lesson::factory()->create();
    }
}
