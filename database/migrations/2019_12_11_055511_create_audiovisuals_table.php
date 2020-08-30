<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiovisualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiovisuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->date('time');
            $table->boolean('assistance')->nullable();// en true cuando el pago esta procesado

            $table->unsignedBigInteger('employee_id')->unsigned();
            $table->unsignedBigInteger('provider_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audiovisuals');
    }
}
