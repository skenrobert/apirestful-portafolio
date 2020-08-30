<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateinventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            
            $table->unsignedBigInteger('shop_id')->unsigned()->nullable();
            // $table->unsignedBigInteger('monitor_id')->unsigned()->nullable();
            // $table->unsignedBigInteger('company_id')->unsigned();

            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            // $table->foreign('monitor_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('inventories');
    }
}
 