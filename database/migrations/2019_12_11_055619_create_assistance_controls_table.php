<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistanceControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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
            $table->text('Observation');
            $table->time('beginning');
            $table->time('end');

            $table->unsignedBigInteger('assistancecontrols_id')->unsigned();
            $table->unsignedBigInteger('employee_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('assistancecontrols_id')->references('id')->on('assistance_controls')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

        Schema::create('receipt_of_payment', function (Blueprint $table) { 
            $table->bigIncrements('id');


            $table->unsignedBigInteger('payroll_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('cascade');
        });


        


        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_of_payment');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('assistance_controls');
    }
}
