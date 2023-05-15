<?php

namespace Api\V1\Course;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_not_update_course_because_id_is_not_valid()
    {
        $this->putJson(route('api.v1.courses.update', 1), [
            'price' => 1,
        ])->assertStatus(404);
    }

    public function test_user_can_not_update_course_by_wrong_data()
    {
        $course = $this->createCourse();

        $this->putJson(route('api.v1.courses.update', $course->id), [
            'price' => 'test',
        ])->assertStatus(422);
    }

    public function test_user_can_update_course()
    {
        $course = $this->createCourse();

        $this->putJson(route('api.v1.courses.update', $course->id), [
            'price' => 1000,
        ])->assertSuccessful()
            ->assertStatus(200);

        $this->assertEquals(1, Course::wherePrice(1000)->count());
    }

    private function createCourse()
    {
        return Course::factory()->create();
    }
}
