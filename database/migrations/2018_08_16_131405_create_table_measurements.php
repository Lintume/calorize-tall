<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMeasurements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->float('kg')->unsigned()->default(0);
            $table->float('chest_cm')->default(0);
            $table->float('waist_cm')->default(0);
            $table->float('thighs_cm')->default(0);
            $table->float('wrist_cm')->default(0);
            $table->float('neck_cm')->default(0);
            $table->float('biceps_cm')->default(0);
            $table->unsignedInteger('mood')->default(0);
            $table->unsignedInteger('hunger')->default(0);
            $table->unsignedInteger('kpdn')->default(0);
            $table->float('sleep')->unsigned()->default(0);
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
        Schema::dropIfExists('measurements');
    }
}
