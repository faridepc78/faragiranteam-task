<?php

namespace App\Repositories\Course;

use App\Models\Course;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public Model $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }
}
