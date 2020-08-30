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

            $table->unsignedBigInteger('employees_id')->unsigned();
            $table->unsignedBigInteger('providers_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('providers_id')->references('id')->on('providers')->onDelete('cascade');
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
