<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('phone')->nullable();
            $table->text('address');
            
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('provider_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });


        // Schema::create('purchases', function (Blueprint $table) {
        //     $table->bigIncrements('id');

        //     $table->unsignedBigInteger('purchase_order_id')->unsigned();

        //     $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');

        //     $table->timestamps();
        // });


        Schema::create('item_purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quantity');
            $table->float('price');


            $table->unsignedBigInteger('item_id')->unsigned();
            $table->unsignedBigInteger('purchase_order_id')->unsigned();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');

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
        Schema::dropIfExists('item_purchase_orders');
        // Schema::dropIfExists('purchases');
        Schema::dropIfExists('purchase_orders');
    }
}
