<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactType extends Model
{
    protected $table = 'contact_types';

    protected $fillable = ['name'];
}
