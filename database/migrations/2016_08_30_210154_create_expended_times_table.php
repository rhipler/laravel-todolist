<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendedTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expended_times', function (Blueprint $table) {
            $table->increments('id');
            $table->timestampsTz();
            $table->timestampTz('deleted_at')->nullable();
            $table->text('description');
            $table->double('time');
            $table->integer('task_id')->nullable(false);
            $table->date('date');
            $table->integer('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expended_times');
    }
}
