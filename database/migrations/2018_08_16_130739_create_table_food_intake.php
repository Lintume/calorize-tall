<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFoodIntake extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_intake', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('g')->default(0);
            $table->unsignedInteger('proteins')->default(0);
            $table->unsignedInteger('fats')->default(0);
            $table->unsignedInteger('carbohydrates')->default(0);
            $table->unsignedInteger('calories')->default(0);
            $table->unsignedInteger('type_food_intake');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_intake');
    }
}
