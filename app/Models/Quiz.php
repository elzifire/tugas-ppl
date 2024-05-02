<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // protected $fillable = ['category_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];
    protected $guarded = [];


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/quiz/' . $value),
        );
    }

    public function category()
    {
        return $this->belongsTo(QuizCategory::class);
    }
}
