<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $deal_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deal|null $deals
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag whereDealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DealTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DealTag extends Model
{
    protected $fillable = ['name', 'deal_id'];

    public function deals()
    {
        return $this->belongsTo(Deal::class);
    }
}
