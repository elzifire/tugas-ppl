<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Find;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data lama
        DB::table('finds')->truncate();

        // Buat data baru
        for ($i = 0; $i < 10; $i++) {
            Find::create([
                'user_id' => 2, // Sesuaikan dengan user_id yang valid
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Find::create([
                'user_id' => 3, // Sesuaikan dengan user_id yang valid
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
