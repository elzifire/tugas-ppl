<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('quiz_categories')->insert([
            ['name' => 'Math'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'Geography'],
            ['name' => 'Literature'],
        ]);
    }
}
