<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;

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
            $table->boolean('couples')->default(0);
            $table->string('name_couple')->nullable();//nombre cuando son parejas
            $table->string('document_number')->unique()->nullable(); 
            $table->json('sites')->default(new Expression('(JSON_ARRAY())'));

            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('user_request_id');
            $table->unsignedBigInteger('company_id');
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('user_request_id')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

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
