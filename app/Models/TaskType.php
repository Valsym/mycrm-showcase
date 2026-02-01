<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaskType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskType extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
}
