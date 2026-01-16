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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('instagram')->nullable();
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->text('text');
            
            // Admin moderation
            $table->boolean('is_approved')->default(false);
            
            $table->timestamps();
            
            // One review per user
            $table->unique('user_id');
            
            // Index for showing approved reviews
            $table->index(['is_approved', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
