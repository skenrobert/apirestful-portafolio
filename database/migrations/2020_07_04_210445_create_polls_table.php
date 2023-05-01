<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
 
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('webcam_model')->default(0);
            $table->boolean('does_anal')->default(0);
            $table->boolean('tattoos')->default(0);
            $table->boolean('smoke')->default(0);
            $table->boolean('sex_toys')->default(0);
            $table->boolean('pubic_hair')->default(0);
            $table->boolean('lactation')->default(0);
            $table->boolean('piercings')->default(0);

            $table->BigInteger('number_children')->nullable();
            $table->double('weight')->nullable();

            $table->text('pages_worked');
            $table->text('like_sexually');
            $table->text('turns_on_sexually');
            $table->text('turns_off_sexually');

            $table->string('zodiac_sign')->nullable();
            $table->string('occupation')->nullable();
            $table->string('height')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('bust_size')->nullable();
            $table->string('hip_size')->nullable();
            $table->string('blocked_countries')->nullable();
            $table->string('sexual_preference')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('favorite_color')->nullable();
            $table->string('english_level')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('waist_size')->nullable();
            $table->string('hobby')->nullable();
            $table->string('nick_suggestion')->nullable();

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->unsigned()->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
