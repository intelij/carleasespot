<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateVehicleModelsTable.
 */
class CreateVehicleModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicle_models', function(Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('name', 191);
            $table->string('make_id', 36);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('make_id')->references('uuid')->on('vehicle_makes')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehicle_models');
	}
}
