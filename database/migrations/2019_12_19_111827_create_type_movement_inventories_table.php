<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMovementInventoriesTable extends Migration
{
    
    public function up()
    {
        Schema::create('movement_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('phone')->nullable();
            $table->text('address');
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });
        
        Schema::create('type_movement_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->bigInteger('invoce_number')->nullable();
            $table->bigInteger('quantityIn')->nullable();
            $table->double('totalIn')->nullable();
            $table->double('unitpriceIn')->nullable();
            $table->double('totalOut')->nullable();
            $table->double('unitpriceOut')->nullable();
            $table->bigInteger('quantityOut')->nullable();
            $table->double('totalInventory')->nullable();
            $table->double('unitpriceInventory')->nullable();
            $table->bigInteger('quantityInventory')->nullable();
            $table->date('date')->nullable();

            $table->unsignedBigInteger('movement_type_id')->unsigned();
            $table->unsignedBigInteger('inventory_id')->unsigned();
            $table->unsignedBigInteger('store_id')->unsigned()->nullable();
            $table->unsignedBigInteger('item_id')->unsigned();
            $table->unsignedBigInteger('bill_to_charge_id')->unsigned()->nullable();
            $table->unsignedBigInteger('purchase_order_id')->unsigned()->nullable();

            $table->foreign('movement_type_id')->references('id')->on('movement_type')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('bill_to_charge_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('type_movement_inventories');
        Schema::dropIfExists('movement_type');
        Schema::dropIfExists('stores');
    }
}
