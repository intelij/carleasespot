<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNewsletterSignupsTable.
 */
class CreateNewsletterSignupsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_signups', function(Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('email', 30);
            $table->boolean('status')->default(1);
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
		Schema::drop('newsletter_signups');
	}
}
