<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistanceControlsTable extends Migration
{

    public function up()
    {
        Schema::create('assistance_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('beginning');
            $table->time('end');
            $table->text('description');

            $table->unsignedBigInteger('employee_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

        Schema::create('payroll', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation')->nullable();
            $table->date('beginning');
            $table->date('end');
            $table->double('total')->nullable();
            $table->BigInteger('number_control')->nullable();


            $table->unsignedBigInteger('assistancecontrol_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('assistancecontrol_id')->references('id')->on('assistance_controls')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::create('receipt_of_payment', function (Blueprint $table) { 
            $table->bigIncrements('id');
            $table->text('observation')->nullable();
            $table->double('pay_salary');
            $table->double('paycommission')->nullable();
            $table->double('production')->nullable();
            $table->double('commission')->nullable();
            $table->BigInteger('number_receipt')->nullable();

            $table->double('ret_fte')->nullable();
            $table->double('value_collect')->nullable();
            $table->double('value_pay')->nullable();

            $table->unsignedBigInteger('payroll_id')->unsigned()->nullable();
            $table->unsignedBigInteger('event_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

    }

    public function down()
    {
        Schema::dropIfExists('receipt_of_payment');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('assistance_controls');
    }
}
