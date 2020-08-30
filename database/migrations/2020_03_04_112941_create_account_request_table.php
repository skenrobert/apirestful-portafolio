<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname');//posible nick name
            // $table->string('name');//posible nick name
            // $table->double('total_provider_week');//se basa en sacar la estimacion de toda la semana 
            // $table->double('participation_current_week')->default(0);//tiene el porcentaje de comparacion con la semana anterior si es 0,0 es que es su primera semana

            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('user_create_id');
            $table->unsignedBigInteger('user_request_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('company_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('user_create_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_request_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_request');
    }
}
