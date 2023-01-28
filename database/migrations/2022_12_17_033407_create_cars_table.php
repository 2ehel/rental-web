<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->integer('owner_id')->nullable();
            $table->text('description')->nullable();
            $table->string('brand',10);
            $table->string('model',10)->nullable();
            $table->string('car_plate',10)->unique();
            // $table->string('ic_number', 12)->unique();
            $table->integer('year_register')->nullable();
            $table->integer('charge_per_hour')->nullable();
            $table->integer('charge_per_day')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::update("ALTER TABLE cars AUTO_INCREMENT = 100;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
