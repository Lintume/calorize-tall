<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->float('proteins')->nullable();
            $table->float('fats')->nullable();
            $table->float('carbohydrates')->nullable();
            $table->float('calories')->nullable();
            $table->boolean('base')->default(true);
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->float('total_weight')->unsigned()->nullable();
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
        Schema::dropIfExists('products');
    }
}
