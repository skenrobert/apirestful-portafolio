<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillToPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_to_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->enum('way_to_pay',['cash','credit','transfer']);
            $table->string('transfer_code');
            // $table->bigInteger('bills_to_pay_credit_id')->nullable();
            $table->bigInteger('quantity');
            $table->float('total_cost');
            $table->float('total_paid');

            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('companies_id')->unsigned();
            $table->unsignedBigInteger('events_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('companies_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('invoice_provider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->bigInteger('quantity');
            $table->float('cost');
            $table->text('description');
            $table->float('total');

            $table->unsignedBigInteger('billtopays_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('billtopays_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
        });


        Schema::create('bill_to_pays_has_providers', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('billtopays_id')->unsigned();
            $table->unsignedBigInteger('providers_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('billtopays_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
            $table->foreign('providers_id')->references('id')->on('providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('bill_to_pays_has_providers');
        Schema::dropIfExists('bill_to_pays');
    }
}
