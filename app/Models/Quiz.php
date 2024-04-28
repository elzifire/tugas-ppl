<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];

    public function category()
    {
        return $this->belongsTo(QuizCategory::class);
    }
}
