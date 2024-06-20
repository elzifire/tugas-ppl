<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Reward extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function redeemRewards()
    {
        return $this->hasMany(RedeemReward::class);
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/rewards/' . $value),
        );
    }
    
}
