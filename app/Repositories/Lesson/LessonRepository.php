<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public Model $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }
}
