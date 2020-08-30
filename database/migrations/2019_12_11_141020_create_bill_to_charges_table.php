<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillToChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_to_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->float('total_paid');
            $table->float('cost');
            $table->bigInteger('quantity');
            $table->float('total_cost');

            $table->unsignedBigInteger('events_id')->unsigned();
            $table->unsignedBigInteger('shops_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('shops_id')->references('id')->on('shops')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('clients_has_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->enum('payment_method',['cash','check','consignment','transfer']);
            $table->string('transfer_code');
            $table->bigInteger('dues');//numero de cuotas
            $table->float('paid');

            $table->unsignedBigInteger('clients_id')->unsigned();//cliente
            $table->unsignedBigInteger('billtocharges_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('billtocharges_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
        });
        
        Schema::create('sales_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->bigInteger('quantity');
            $table->float('cost');
            $table->text('description');
            $table->float('total');
           
            $table->unsignedBigInteger('billtocharges_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('billtocharges_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_invoice');
        Schema::dropIfExists('clients_has_payments');
        Schema::dropIfExists('bill_to_charges');
    }
}
