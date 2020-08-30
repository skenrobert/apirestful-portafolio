<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->unsignedBigInteger('companies_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('activity');
            $table->bigInteger('referrer_activities_id')->nullable();
            $table->text('description');

            $table->unsignedBigInteger('projects_id')->unsigned();
            $table->unsignedBigInteger('shifts_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('shifts_id')->references('id')->on('shifts')->onDelete('cascade');
        });

        Schema::create('projects_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            
            $table->unsignedBigInteger('activities_id')->unsigned();
            $table->unsignedBigInteger('jobfunctions_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('activities_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('jobfunctions_id')->references('id')->on('job_functions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_tasks');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('projects');
    }
}
