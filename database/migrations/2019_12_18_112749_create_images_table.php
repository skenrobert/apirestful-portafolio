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
    
    Schema::create('boutique_image', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('boutique_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('boutique_id')->references('id')->on('boutiques')->onDelete('cascade');

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

    Schema::create('account_request_image', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('account_request_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('account_request_id')->references('id')->on('account_request')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('image_auditshift', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('auditshift_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('auditshift_id')->references('id')->on('audit_shifts')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('image_item', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('item_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('image_user', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('user_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('audiovisual_image', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('image_id')->unsigned();
        $table->unsignedBigInteger('audiovisual_id');

        $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        $table->foreign('audiovisual_id')->references('id')->on('audiovisuals')->onDelete('cascade');

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
        Schema::dropIfExists('image_audiovisual');
        Schema::dropIfExists('image_user');
        Schema::dropIfExists('image_item');
        Schema::dropIfExists('image_auditshift');
        Schema::dropIfExists('account_request_image');
        Schema::dropIfExists('company_image');
        Schema::dropIfExists('image_provider');
        Schema::dropIfExists('image_boutique');
        Schema::dropIfExists('images');
    }
}
