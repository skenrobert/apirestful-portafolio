<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{

    // 1. CONTRATO DE REPRESENTANTE ARTÍSTICO
    // 2. CONTRATO DE MANDATO SATELITE STUDIO
    // 3. CONTRATO DE MANDATO CON BIENES MUEBLES 
    // 4. CONTRATO DE CESIÓN DE DERECHOS DE IMAGEN
    // 5. CONTRATO DE MANDATO SUBSTUDIO STUDIO
    // 6. CONTRATO INDIVIDUAL DE TRABAJO A TÉRMINO FIJO 

    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) { // guardar la fecha aunque no es de ser necesario porque el contrato que ella deben visualizar es el firmado y subido
            $table->bigIncrements('id');

            //1. compact('user','expedida')
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->default('0')->nullable(); // 0 = Cédula | 1 = Pasaporte
            $table->string('issued')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_phone')->nullable();

            //2. //compact('user','mandante','mandatario','numeroMandato','expedida','departamento')
            $table->string('percentage_mandatario')->nullable();//80%
            $table->string('percentage_mandante')->nullable();//20%
            $table->string('number_mandato')->nullable();//20%
            $table->string('department')->nullable();//20%

            //3 compact('user','pareja','numero_documento','departamento','porciento_nu','porciento','valor','equipo')
            $table->string('couple_name')->nullable();
            $table->string('document_type_couple')->nullable();
            $table->string('document_number_couple')->default('0')->nullable();
            $table->string('percentage_number')->nullable();
            $table->string('percentage')->nullable();
            $table->string('valor')->nullable();// computer
            $table->text('equipment')->nullable();// computer

            //4. compact('user','expedida')

            //5. compact('subStudy','expedida','porciento_nu','porciento')
            // $table->unsignedBigInteger('subStudy_id')->unsigned()->nullable();

            //6. compact('user', 'LugNacNacionalidad', 'cargo', 'salario', 'salarioEscri', 'peripago', 'fechain', 'fechafin', 'expedida', 'termino', 'funciones', 'duracion')
            $table->string('nationality')->nullable();
            $table->string('position')->nullable();
            $table->string('salary')->nullable();
            $table->string('salary_written')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('payment_period')->nullable();
            $table->text('function')->nullable();
            $table->text('duration')->nullable();
            $table->text('finished')->nullable();//TÉRMINO FIJO DE UN AÑO

            $table->enum('contract_type',[ 1, 2, 3, 4, 5, 6])->nullable();
            $table->boolean('status')->default(0); // Sigin 

            // $table->enum('gender',['Mujer', 'Pareja', 'Hombre', 'Trans'])->default('Mujer');

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->unsigned()->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            // $table->foreign('subStudy_id')->references('id')->on('companies')->onDelete('cascade');

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
        Schema::dropIfExists('contracts');
    }
}
