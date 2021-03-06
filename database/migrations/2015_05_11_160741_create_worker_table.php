<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('dni');
            $table->string('birthdate');
            $table->string('location');
            $table->string('email')->unique();
            $table->integer('tasquescompletes');
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
		Schema::drop('worker');
	}

}
