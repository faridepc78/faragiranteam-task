<?php

namespace App\Http\Resources\Api\V1\Lesson;

use App\Http\Resources\Api\V1\Course\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'course' => $this->whenLoaded('course', function () {
                return CourseResource::make($this->course);
            }),
        ];
    }
}
