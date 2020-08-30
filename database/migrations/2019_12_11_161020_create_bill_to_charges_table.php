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
            $table->text('description')->nullable();
            $table->double('total_paid');
            // $table->double('cost');
            $table->bigInteger('quantity');
            $table->double('total_cost');
            $table->boolean('production_system')->default('0');//acrivo o desctivado

            $table->unsignedBigInteger('event_id')->unsigned()->nullable();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('accounting_id')->unsigned()->nullable();
            $table->unsignedBigInteger('bill_to_pay_id')->unsigned()->nullable();

            $table->foreign('bill_to_pay_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
            $table->foreign('accounting_id')->references('id')->on('accountings')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_has_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->enum('payment_method',['cash','check','consignment','transfer']);
            $table->string('transfer_code');
            $table->bigInteger('dues');//numero de cuotas
            $table->double('paid');

            $table->unsignedBigInteger('person_id');//cliente
            $table->unsignedBigInteger('bill_to_charge_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('bill_to_charge_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
        });
        
        Schema::create('sales_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->text('description_null')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total')->nullable();
            $table->json('details')->nullable();
           
            $table->unsignedBigInteger('bill_to_charge_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('bill_to_charge_id')->references('id')->on('bill_to_charges')->onDelete('cascade');
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
