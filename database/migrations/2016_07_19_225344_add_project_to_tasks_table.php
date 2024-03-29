<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddProjectToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks',function(Blueprint $table){
            $table->unsignedBigInteger('projectid')->nullable(false);
            $table->foreign('projectid')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks',function(Blueprint $table) {
            $table->dropForeign(['projectid']);
            $table->dropColumn('projectid');
        });
    }
}
