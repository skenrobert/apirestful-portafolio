<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });
    
    Schema::create('image_provider', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('provider_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    // Schema::create('image_company', function (Blueprint $table) {
       Schema::create('company_image', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('company_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('accountrequest_image', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('account_request_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('account_request_id')->references('id')->on('account_request')->onDelete('cascade');

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
        Schema::dropIfExists('company_image');
        Schema::dropIfExists('image_provider');
        Schema::dropIfExists('images');
    }
}
