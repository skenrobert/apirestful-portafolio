<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMovementHasInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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

            $table->softDeletes();
            $table->timestamps();

        });


        Schema::create('type_movement_has_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quantity');
            $table->bigInteger('stock');
            $table->text('description');

            $table->unsignedBigInteger('movementtype_id')->unsigned()->nullable();
            $table->unsignedBigInteger('stores_id')->unsigned()->nullable();
            $table->unsignedBigInteger('inventories_id')->unsigned();
            $table->unsignedBigInteger('billtocharges_id')->unsigned()->nullable();
            $table->unsignedBigInteger('items_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('movementtype_id')->references('id')->on('movement_type')->onDelete('cascade');
            $table->foreign('stores_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('billtocharges_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('inventories_id')->references('id')->on('inventories')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()

    {
        
        Schema::dropIfExists('type_movement_has_inventories');
        Schema::dropIfExists('movement_type');
        Schema::dropIfExists('stores');
        
    }
}
