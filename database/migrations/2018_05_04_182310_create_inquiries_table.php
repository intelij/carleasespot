<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInquiriesTable.
 */
class CreateInquiriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inquiries', function(Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('dealer_id', 36);
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191);
            $table->string('car', 191);
            $table->string('phone', 191);
            $table->string('price', 36);
            $table->text('message');
            $table->boolean('type')->default(1);
            $table->timestamps();
            $table->foreign('dealer_id')->references('uuid')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inquiries');
	}
}
