<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function(Blueprint $table)
        {
            $table->string('uuid', 36)->primary();
            $table->string('name', 191);
            $table->string('email', 191)->unique();
            $table->string('photo', 191)->nullable();
            $table->boolean('status')->default(1);
            $table->string('password', 60);
            $table->string('remember_token', 100)->nullable();
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
        Schema::drop('admins');
    }

}
