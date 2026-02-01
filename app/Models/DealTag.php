<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealTag extends Model
{
    protected $fillable = ['name', 'deal_id'];

    public function deals()
    {
        return $this->belongsTo(Deal::class);
    }
}
