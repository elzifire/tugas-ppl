<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $categories = DB::table('quiz_categories')->pluck('id');

        foreach ($categories as $categoryId) {
            for ($i = 0; $i < 50; $i++) {
                DB::table('quizzes')->insert([
                    'category_id' => $categoryId,
                    'image' => $faker->imageUrl(640, 480, 'cats', true, 'Faker'),
                    'question' => $faker->sentence,
                    'option_a' => $faker->word,
                    'option_b' => $faker->word,
                    'option_c' => $faker->word,
                    'option_d' => $faker->word,
                    'correct_answer' => $faker->randomElement(['A', 'B', 'C', 'D']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
