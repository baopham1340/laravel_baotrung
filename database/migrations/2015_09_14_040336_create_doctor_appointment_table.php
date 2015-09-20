<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('doctor_appointment', function($table)
        {
            $table->increments('id');
            $table->string('api_key');
            $table->datetime('time');
            $table->string('doctor');
            $table->string('place');
            $table->string('reason');

            $table->foreign('api_key')
                  ->references('api_key')->on('users')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('doctor_appointment');
    }
}
