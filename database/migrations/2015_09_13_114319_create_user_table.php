<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function($table)
        {
            $table->string('api_key');
            $table->string('username',30);
            $table->string('pass_hash',255);
            $table->string('email',30)->nullable();
            $table->string('sdt',15)->nullable();
            $table->timestamps();

            $table->unique('username');
            $table->index('username');
            $table->primary('api_key');
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
        Schema::dropIfExists('users');
    }
}
