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
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();

                $table->float('kcal_per_day_normal')->nullable();
                $table->float('kcal_per_day')->nullable();
                $table->float('fat_percent')->nullable();
                $table->integer('BMR')->nullable();
                $table->float('BMI')->nullable();
                $table->integer('breakfast_percent')->nullable();
                $table->integer('lunch_percent')->nullable();
                $table->integer('dinner_percent')->nullable();
                $table->integer('snack_percent')->nullable();
                $table->string('product_hash')->nullable();
                $table->string('sex')->nullable();
                $table->integer('growth_cm')->nullable();
                $table->float('activity_coefficient')->nullable();
                $table->integer('deficit_kcal')->nullable();
                $table->float('target_kg')->nullable();
                $table->date('birthday_date')->nullable();
            });
        }

        if (! Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (! Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
