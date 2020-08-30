<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('job_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->double('value')->default(1);//es en porcentaje segun las modelos de pago de salario
            $table->double('salary')->default(1000000);

            // $table->unsignedBigInteger('company_id')->nullable();     

            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('job_functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('job_type_id')->unsigned();     

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_functions');
        Schema::dropIfExists('job_types');
    }
}
