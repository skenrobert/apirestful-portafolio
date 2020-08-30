<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountReceiptModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_receipt_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('token_pago')->nullable();
            $table->double('dolar_pago')->nullable();
            $table->double('pesos_pago')->nullable();
            $table->double('retefuente')->nullable();
            $table->double('total_pago')->nullable();

            $table->string('document_number')->default('0')->nullable(); // 0 = Cédula | 1 = Pasaporte
            $table->string('name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->text('observation')->nullable();

            $table->double('token_mfc')->nullable();
            $table->double('token_chat')->nullable();
            $table->double('token_stripchat')->nullable();
            $table->double('token_camsoda')->nullable();
            $table->double('token_bongas')->nullable();
            $table->double('token_cam4')->nullable();
            $table->double('token_jasmin')->nullable();
            $table->double('token_streamate')->nullable();
            $table->double('token_manyvids')->nullable();
            $table->double('token_naked')->nullable();
            $table->double('token_youporn')->nullable();
            $table->double('token_dirty')->nullable();

            $table->double('dolar_mfc')->nullable();
            $table->double('dolar_chat')->nullable();
            $table->double('dolar_stripchat')->nullable();
            $table->double('dolar_camsoda')->nullable();
            $table->double('dolar_bongas')->nullable();
            $table->double('dolar_cam4')->nullable();
            $table->double('dolar_jasmin')->nullable();
            $table->double('dolar_streamate')->nullable();
            $table->double('dolar_manyvids')->nullable();
            $table->double('dolar_naked')->nullable();
            $table->double('dolar_youporn')->nullable();
            $table->double('dolar_dirty')->nullable();

            $table->double('pesos_mfc')->nullable();
            $table->double('pesos_chat')->nullable();
            $table->double('pesos_stripchat')->nullable();
            $table->double('pesos_camsoda')->nullable();
            $table->double('pesos_bongas')->nullable();
            $table->double('pesos_cam4')->nullable();
            $table->double('pesos_jasmin')->nullable();
            $table->double('pesos_streamate')->nullable();
            $table->double('pesos_manyvids')->nullable();
            $table->double('pesos_naked')->nullable();
            $table->double('pesos_youporn')->nullable();
            $table->double('pesos_dirty')->nullable();

            // la auditoria general, auditoria de turno(room), audiovisuales(), conexion, otros (pueden generar una multa por locker o por botique), si tiene una production falta al reglamento

            $table->double('audiovisual')->nullable();
            $table->double('conection')->nullable();
            $table->double('audit')->nullable();
            $table->double('auditshift')->nullable();//room
            $table->double('rule_production')->nullable();
            $table->double('other')->nullable();
            $table->double('deductibility_total')->nullable();
            $table->double('total_pesos')->nullable();
            
            // $table->string('compras')->nullable();
            // $table->string('huellero')->nullable();
            // $table->string('conexion')->nullable();
            // $table->string('ingle')->nullable();
            // $table->string('maquillaje')->nullable();
            // $table->string('sabana')->nullable();
            // $table->string('teclado')->nullable();
            // $table->string('redes_sociales')->nullable();
            // $table->string('eps')->nullable();
            // $table->string('refrigerios')->nullable();

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('account_receipt_models');
    }
}
