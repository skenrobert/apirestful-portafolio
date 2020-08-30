<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->string('name');
            $table->string('last_name');$table->bigIncrements('id');
            $table->string('mobile_phone')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate');
            $table->text('address');
            $table->integer('document_type')->default('0'); // 0 = Cédula | 1 = Pasaporte
            $table->string('document_number')->unique(); 
            $table->boolean('sigin')->default(1); // Sigin 
            $table->boolean('rut')->nullable();            
            $table->enum('gender',['Mujer', 'Pareja', 'Hombre', 'Trans'])->default('Mujer');
            $table->integer('nationality')->default(0); // 0 = Colombiana | 1 = Extranjera
            $table->string('bank_account')->nullable();

            $table->unsignedBigInteger('epss_id')->unsigned()->nullable();
            $table->unsignedBigInteger('banks_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('epss_id')->references('id')->on('epss')->onDelete('cascade');
            $table->foreign('banks_id')->references('id')->on('banks')->onDelete('cascade');

        });
    

        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('init');

            $table->unsignedBigInteger('person_id')->unsigned();
            $table->unsignedBigInteger('jobtype_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('jobtype_id')->references('id')->on('job_types');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');

        });


        // Schema::create('clients', function (Blueprint $table) {
        //     $table->bigIncrements('id');

        //     $table->unsignedBigInteger('person_id')->unsigned();
                        
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        // });


        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('init');
            
            $table->unsignedBigInteger('person_id')->unsigned();
            $table->unsignedBigInteger('jobtype_id')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('jobtype_id')->references('id')->on('job_types')->onDelete('cascade');

        });






    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        // Schema::dropIfExists('clients');
        Schema::dropIfExists('providers');
        Schema::dropIfExists('people');

    }
}
