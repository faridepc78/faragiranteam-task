<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Lesson model class
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $course_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

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
            'course_id',
        ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
