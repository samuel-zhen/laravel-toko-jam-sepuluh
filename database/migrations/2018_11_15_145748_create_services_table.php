<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('delivery_id')->nullable();
            $table->string('owner_name');
            $table->string('phone_number');
            $table->string('merk');
            $table->string('serial_number');
            $table->string('technician')->nullable();
            $table->integer('down_payment')->default(0);
            $table->integer('fee')->default(0);
            $table->integer('status')->default(0);
            $table->text('note');
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
        Schema::dropIfExists('services');
    }
}
