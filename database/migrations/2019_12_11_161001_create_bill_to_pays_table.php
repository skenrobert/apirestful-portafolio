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
            $table->text('description')->nullable();
            $table->enum('way_to_pay',['cash','credit','transfer'])->nullable();
            $table->string('transfer_code')->nullable();
            // $table->bigInteger('bills_to_pay_credit_id')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->double('total_cost');
            $table->double('total_paid')->nullable();
            $table->boolean('production_system')->default('0');//acrivo o desctivado

            $table->unsignedBigInteger('owner_id')->unsigned();
            $table->unsignedBigInteger('event_id')->unsigned();
            $table->unsignedBigInteger('accounting_id')->unsigned()->nullable();
            $table->unsignedBigInteger('purchase_order_id')->unsigned()->nullable();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accounting_id')->references('id')->on('accountings')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('pay_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->bigInteger('quantity');
            $table->double('cost');
            $table->text('description');
            $table->double('total');

            $table->unsignedBigInteger('bill_to_pay_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('bill_to_pay_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
        });


        Schema::create('bill_to_pay_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('paid');

            $table->unsignedBigInteger('bill_to_pay_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('bill_to_pay_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('bill_to_pay_company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('paid');

            $table->unsignedBigInteger('bill_to_pay_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('bill_to_pay_id')->references('id')->on('bill_to_pays')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_to_pay_company');
        Schema::dropIfExists('bill_to_pay_user');
        Schema::dropIfExists('pay_order');
        Schema::dropIfExists('bill_to_pays');
    }
}
