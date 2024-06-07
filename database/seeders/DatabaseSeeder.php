<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barcode;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        $this->call(QuizCategorySeeder::class);
        // $this->call(QuizSeeder::class);
        // $this->call(BarcodeSeeder::class);
        // Create some barcodes
      
    }
}
