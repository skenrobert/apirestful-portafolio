<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url');
            $table->enum('pay',['Tokens','Dolares','Euros']);
            $table->double('token_value');//$ 100 / token_value 0.05 = tokens 2000

            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname');
            $table->text('description')->nullable();
            $table->string('password')->nullable();
            $table->date('create_date')->nullable();//fecha de creacion de la cuenta 
            $table->string('email')->nullable();
            $table->integer('status')->default(0); // [0 = Inactiva | 1 = Activa]

            $table->unsignedBigInteger('site_id')->unsigned();
            $table->unsignedBigInteger('user_create_id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id')->unsigned();//modelo
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('account_request_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('user_create_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_request_id')->references('id')->on('account_request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('sites');
    }
}
