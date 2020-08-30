<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('beginning');
            $table->date('end');
            $table->time('hour_beginning');
            $table->time('hour_end');
            $table->text('observation');
           
            $table->softDeletes();
            $table->timestamps();

        });


        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            
            $table->unsignedBigInteger('schedule_id')->unsigned();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->integer('creditos');
            // $table->bigInteger('referrersubjects_id')->nullable();

            $table->unsignedBigInteger('course_id')->unsigned();
            $table->unsignedBigInteger('referrer_subject_id')->nullable();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('referrer_subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });

        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('course_id')->unsigned();

                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

        });

        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('note')->default(0);
            $table->text('observation');

            $table->unsignedBigInteger('record_id')->unsigned();
            $table->unsignedBigInteger('subject_id')->unsigned();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });

        // Schema::create('record_trainings', function (Blueprint $table) {
        //     $table->bigIncrements('id');
            

        //     $table->unsignedBigInteger('record_id')->unsigned();
        //     $table->unsignedBigInteger('trainings_id')->unsigned();
                        
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('record_id')->references('id')->on('record')->onDelete('cascade');
        //     $table->foreign('trainings_id')->references('id')->on('trainings')->onDelete('cascade');
        // });

        // Schema::create('training_companies', function (Blueprint $table) {
        //     $table->bigIncrements('id');
            

        //     $table->unsignedBigInteger('companies_id')->unsigned();
        //     $table->unsignedBigInteger('trainings_id')->unsigned();
                        
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
        //     $table->foreign('trainings_id')->references('id')->on('trainings')->onDelete('cascade');
        // });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        // Schema::dropIfExists('training_companies');
        // Schema::dropIfExists('record_trainings');
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('record');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('schedules');

    }
}
