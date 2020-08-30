<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('notification_preference')->default('database');
            $table->boolean('status')->default('1');//acrivo o desctivado
            $table->rememberToken();
            
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('person_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
