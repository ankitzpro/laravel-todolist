<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('task_title',50)->nullable();
            $table->char('assigned_to',50)->nullable();
            $table->char('description',250)->nullable();
            $table->boolean('status')->default('1');
            $table->date('date')->nullable();
            $table->integer('duration')->nullable();
            $table->char('priority',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
