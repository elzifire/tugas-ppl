<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('point');
            $table->string('description');
            $table->string('image')->nullable();
            $table->integer('stock');
            $table->timestamps();
        });

        // tabel riwayat redeem reward
        Schema::create('redeem_rewards', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reward_id');
            $table->integer('point');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_rewards');
        Schema::dropIfExists('rewards');
    }
};
