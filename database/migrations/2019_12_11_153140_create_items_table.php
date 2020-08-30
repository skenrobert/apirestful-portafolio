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
            $table->bigInteger('unity');
            $table->float('sale_price');
            $table->bigInteger('stock');
            $table->bigInteger('stockAlert');//TODO: Funcion que regrese un bool a raiz de esto

            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('account_plan_id')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('account_plan_id')->references('id')->on('account_plan')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('value');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('item_tax', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('item_id')->unsigned();
            $table->unsignedBigInteger('tax_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_taxes');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('items');
    }
}
