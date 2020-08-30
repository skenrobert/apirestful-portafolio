<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->string('unity');
            $table->float('sale_price');
            $table->bigInteger('stock');
            $table->bigInteger('stockAlert');//TODO: Funcion que regrese un bool a raiz de esto

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('value');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('items_has_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('items_id')->unsigned();
            $table->unsignedBigInteger('taxes_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('taxes_id')->references('id')->on('taxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_has_taxes');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('items');
    }
}
