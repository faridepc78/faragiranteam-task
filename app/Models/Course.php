<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Course model class
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $guarded =
        [
            'id',
            'created_at',
            'updated_at',
        ];

    protected $fillable =
        [
            'name',
            'price',
        ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
