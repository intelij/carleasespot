<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateListingsTable.
 */
class CreateListingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listings', function(Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('make', 191);
            $table->string('model', 191);
            $table->string('version', 191);
            $table->string('dealer_id', 36);
            $table->text('terms', 65535)->nullable();
            $table->float('price');
            $table->boolean('type')->default(0);
            $table->float('down_payment');
            $table->integer('mileage');
            $table->string('year', 191);
            $table->string('color', 191);
            $table->boolean('insurance')->default(0);
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
		Schema::drop('listings');
	}
}
