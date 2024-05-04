<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id');
            $table->foreign('status_id')->references('id')->on('task_statuses');
            $table->string('name');
            $table->integer('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('executor_id')->nullable()->default(null);
            $table->foreign('executor_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
