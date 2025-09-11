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
        // Only create table if it doesn't exist
        if (!Schema::hasTable('follows')) {
            Schema::create('follows', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('follower_id');
                $table->unsignedBigInteger('following_id');
                $table->timestamps();

                // Foreign key constraints (optional, if users table exists)
                $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');

                // Unique constraint to prevent duplicate follow entries
                $table->unique(['follower_id', 'following_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
