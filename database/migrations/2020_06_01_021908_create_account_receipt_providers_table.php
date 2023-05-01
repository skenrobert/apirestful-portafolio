<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountReceiptProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_receipt_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('control_number')->nullable();
            $table->string('document_number')->default('0')->nullable(); // 0 = Cédula | 1 = Pasaporte
            $table->string('name')->nullable();
            $table->string('bank_number')->nullable();//nombre del banco 
            $table->text('concept')->nullable();
            $table->double('value')->nullable();
            $table->double('rte_fte')->nullable();
            $table->double('rete_ica')->nullable();
            $table->double('value_pay')->nullable();
            $table->string('value_pay_tex')->nullable();

            $table->unsignedBigInteger('event_id')->unsigned()->nullable();
            $table->unsignedBigInteger('provider_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->unsigned()->nullable();
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

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
        Schema::dropIfExists('account_receipt_providers');
    }
}
