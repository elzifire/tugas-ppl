<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barcode;
use Carbon\Carbon;
use App\Models\User;

class BarcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Barcode::create([
                'code' => config('app.url') . '/' . uniqid(),
                'user_id' => $user->id,
                'expires_at' => Carbon::now()->addDays(30) // Atur tanggal kedaluwarsa
            ]);
        }
    }
}
