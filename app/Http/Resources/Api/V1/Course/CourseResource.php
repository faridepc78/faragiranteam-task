<?php

namespace App\Http\Resources\Api\V1\Course;

use App\Http\Resources\Api\V1\Lesson\LessonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'lessons' => $this->whenLoaded('lessons', function () {
                return LessonResource::collection($this->lessons);
            }),
        ];
    }
}
