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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // $table->boolean('term_agreement')->nullable()->default(false);
            $table->string('booking_no', 20)->nullable()->comment('e.g RN0001');
            $table->string('customer_name', 256);
            $table->string('customer_id', 12)->comment('National ID');
            $table->string('car_id', 12)->comment('Car ID');
            // $table->string('referral', 20)->nullable()->comment('Referral');
            $table->string('start_date', 20)->nullable();
            $table->string('end_date')->nullable();
            $table->string('booking_status', 10)->nullable();
            $table->integer('total_pay')->comment('Total Rent');
            $table->integer('created_by')->comment('Created by')->nullable();
            $table->integer('updated_by')->nullable()->comment('Updated by')->nullable();
            $table->timestamps();
            $table->integer('deleted_by')->nullable()->comment('Deleted by')->nullable();
            $table->softDeletes()->comment('Timestamp deleted_at')->nullable();
        });

        DB::update("ALTER TABLE bookings AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
