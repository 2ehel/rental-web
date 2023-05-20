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
            $table->string('car_owner_id', 12)->nullable()->comment('Car Owner ID');;
            $table->string('customer_id', 12)->comment('National ID');
            $table->string('car_id', 12)->comment('Car ID');
            // $table->string('referral', 20)->nullable()->comment('Referral');
            $table->string('start_date', 20)->nullable();
            $table->string('duration_option', 256)->default("hours");
            $table->integer('duration')->nullable();
            $table->string('booking_status', 256)->nullable();
            $table->integer('total_pay')->comment('Total Rent');
            $table->string('invoice_no',25)->nullable();
            $table->integer('created_by')->comment('Created by')->nullable();
            $table->integer('updated_by')->nullable()->comment('Updated by')->nullable();
            $table->timestamps();
            $table->integer('deleted_by')->nullable()->comment('Deleted by')->nullable();
            $table->softDeletes()->comment('Timestamp deleted_at')->nullable();
            $table->string('history_no',25)->nullable();

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
