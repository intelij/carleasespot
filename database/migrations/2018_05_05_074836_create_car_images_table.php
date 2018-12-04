<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCarImagesTable.
 */
class CreateCarImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_images', function(Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('make_id', 36);
            $table->string('model_id', 36);
            $table->string('file_name', 191);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('make_id')->references('uuid')->on('vehicle_makes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('uuid')->on('vehicle_models')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_images');
	}
}
