<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissionEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('comission_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation')->nullable();
            $table->double('paycommission')->nullable();
            $table->double('production')->nullable();
            $table->double('commission')->nullable();
            $table->unsignedBigInteger('event_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('comission_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation')->nullable();
            $table->double('paycommission')->nullable();
            $table->double('production')->nullable();
            $table->double('commission')->nullable();
            $table->unsignedBigInteger('event_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('comission_studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation')->nullable();
            $table->double('paycommission')->nullable();
            $table->double('production')->nullable();
            $table->double('commission')->nullable();
            $table->unsignedBigInteger('event_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comission_studies');
        Schema::dropIfExists('comission_models');
        Schema::dropIfExists('comission_employees');
    }
}
