<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('commission1');//Valor constante, estimado produccion semanal 1.10, tasa de comision empleado 3.333, cantidad de modelos 90% debe aprobar 
            $table->double('percentage1');//Variable para formulas de pago 10% de la produccion y 90%
            $table->string('commission2');//Valor constante, estimado produccion semanal 1.10, tasa de comision empleado 3.333, cantidad de modelos 90% debe aprobar 
            $table->double('percentage2');
            $table->string('commission3');//Valor constante, estimado produccion semanal 1.10, tasa de comision empleado 3.333, cantidad de modelos 90% debe aprobar 
            $table->double('percentage3'); 
            //%(redondeo hacia abajo cuando sean 3 modelos paga con 2 porque en noventa % son 2.7)

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('shift_has_planning', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('confirmed')->default(1);
            $table->enum('status',['Planeacion','Ejecucion','Ejecutada'])->default('Planeacion');
            $table->text('observation')->nullable();
            $table->date('beginning_week')->nullable();//planinng
            $table->date('end_week')->nullable();
            // $table->double('goal_week');//meta semanal
            
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('production_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('tkn_total_week')->nullable();
            $table->double('value_trm')->nullable();
            $table->double('dolar_week_default')->default(600,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
            $table->double('tkn_week_default')->default(12000,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
            $table->double('tkn_week_news')->default(9000,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
            $table->double('dolar_total_week')->nullable();//se basa en sacar la estimacion de toda la semana 
            $table->double('dolar_total_assigned')->nullable();//debe actualizar cuando asigne los dolares en planning provider
            $table->double('tkn_total_assigned')->nullable();//debe actualizar cuando asigne los dolares en planning provider
            $table->double('total_cop')->nullable();//debe actualizar cuando asigne los dolares en planning provider
            $table->text('observation_week')->nullable();
            $table->boolean('closed')->default(0);

            $table->double('minimum_limit')->nullable();//valor minimo de token que son 12000 para todas las modelos al menos que empiece nueva que son 2000 por dia
            $table->double('commission_employed_payment')->nullable();
            $table->double('estimated')->nullable();

            $table->unsignedBigInteger('commission_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('shift_has_planning_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('commission_id')->references('id')->on('commissions')->onDelete('cascade');
            $table->foreign('shift_has_planning_id')->references('id')->on('shift_has_planning')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            //TODO: rutina para generar todas las auditorias de una producion

            $table->unsignedBigInteger('production_master_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('production_master_id')->references('id')->on('production_masters')->onDelete('cascade');
        });

      
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('address');
            $table->text('description');
            $table->integer('status')->default(1);// [[ 0 = Ocupado | 1 = Disponible | 2 = Mantenimiento ]]
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();

        });

  

  
// la semana siempre tiene de 1 a 7 dias, el auto-incremente me va dar simpre de 7 en 7 tengre las semanas
        Schema::create('production_details_days', function (Blueprint $table) {// de la tabla de comisiones se debe sacar un porcentaje de crecimiento esperado del 10%
            $table->bigIncrements('id');
            // $table->double('last_week');//->default(12000,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
            // $table->double('progress_week');//total acumulado
            $table->integer('day_week')->default(1);// 1 = Lunes | 2 = Martes | 3 = Miercoles | 4 = Jueves | 5 = viernes | 6 = sabado |7 = domingo
            $table->double('dolar_total_day')->nullable();//total production for connection model
            $table->double('tkn_total_day')->nullable();//total de la semana
            $table->text('observation_day')->nullable();

            $table->unsignedBigInteger('production_master_id')->nullable()->unsigned();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('production_master_id')->references('id')->on('production_masters')->onDelete('cascade');
        });

        Schema::create('monitor_shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation');    
            $table->boolean('support')->default(0);
            $table->boolean('sunday')->default(0);
            $table->double('goal_dollar_monitor')->nullable();//meta de cada modelo que se guarde semanal
            $table->double('goal_tkn_monitor')->nullable();
            $table->double('dolar_assigned')->nullable();//debe actualizar cuando asigne los dolares en planning provider
            $table->double('tkn_assigned')->nullable();//debe actualizar cuando asigne los dolares en planning provider
            $table->boolean('commission_payment90')->nullable();
            $table->boolean('commission_payment10')->nullable();
            
            $table->unsignedBigInteger('shift_has_planning_id');   
            $table->unsignedBigInteger('monitor_id');   
            $table->unsignedBigInteger('shift_id');   
            $table->unsignedBigInteger('task_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('shift_has_planning_id')->references('id')->on('shift_has_planning')->onDelete('cascade');
            $table->foreign('monitor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });

              
        Schema::create('planning_provider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observation');
            $table->boolean('used')->default(0);//para saber si se uso o no
            $table->double('goal_dollar')->nullable();//meta de cada modelo que se guarde semanal
            $table->double('goal_tkn')->nullable();
            $table->double('production_total_dollar')->nullable();//meta de cada modelo que se guarde semanal
            $table->double('production_total_tkn')->nullable();
            $table->double('participation')->default(0);//debe actualizar cuando asigne los dolares en planning provider

            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('monitor_shift_id');
            // $table->unsignedBigInteger('monitor_id');
            // $table->unsignedBigInteger('shift_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('monitor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('monitor_shift_id')->references('id')->on('monitor_shifts')->onDelete('cascade');
        });


        Schema::create('production_details_shift', function (Blueprint $table) {// de la tabla de comisiones se debe sacar un porcentaje de crecimiento esperado del 10%
            $table->bigIncrements('id');
            // $table->double('last_week');//->default(12000,00);//debe calcularse en base a las semanas anteriores de las modelos revisa imagen de calculos
            // $table->double('progress_week');//total en dolares de la modelo
            $table->double('dolar_total_monitor_shift')->nullable();//se basa en sacar la estimacion de toda la semana 
            $table->text('observation_shift')->nullable();
            $table->double('tkn_total_monitor')->nullable();//total production for shift

            $table->unsignedBigInteger('production_details_day_id')->unsigned();
            // $table->unsignedBigInteger('shift_id')->unsigned();
            $table->unsignedBigInteger('monitor_shift_id')->nullable();//guarda el id del monitor con el total de ese turno

            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('production_details_day_id')->references('id')->on('production_details_days')->onDelete('cascade');
            $table->foreign('monitor_shift_id')->references('id')->on('monitor_shifts')->onDelete('cascade');

        });

        Schema::create('production_details_connec', function (Blueprint $table) {// de la tabla de comisiones se debe sacar un porcentaje de crecimiento esperado del 10%
            $table->bigIncrements('id');
            $table->time('connection_start');
            $table->time('connection_end')->nullable();
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->text('observation_int')->nullable();
            $table->text('observation_end')->nullable();
            $table->double('dolar_total_provider')->nullable();//total production for connection model
            $table->double('tkn_total_provider')->nullable();//total production for connection model

            $table->unsignedBigInteger('production_details_shift_id');
            $table->unsignedBigInteger('user_id');//modelo

            $table->foreign('production_details_shift_id')->references('id')->on('production_details_shift')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('account_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('dolar')->nullable();//cada cuenta que se trabaje asociada a un detalle de producion debe tener los dolares que hizo segun el valor toque del sitio
            $table->bigInteger('tkn');
            // $table->double('estimate');//estimacion por de crecimiento en base a la semana anterior

            $table->unsignedBigInteger('production_details_connec_id')->unsigned();
            $table->unsignedBigInteger('account_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('production_details_connec_id')->references('id')->on('production_details_connec')->onDelete('cascade');
        });

        Schema::create('audit_shifts', function (Blueprint $table) {//llena de la observacion end debe ser llenado por el monitor saliente y el campo confirmacion debe ser llenado por el supervisor
            $table->bigIncrements('id');
            $table->text('location');
            $table->boolean('bed');
            $table->boolean('cleaning');
            $table->boolean('tv');
            $table->boolean('pc');
            $table->boolean('cam');
            $table->boolean('object');//objetos del room
            $table->boolean('confirmed')->default(0);//debe ser habilitado para el supervisor nada mas

            $table->unsignedBigInteger('production_details_connec_id')->unsigned();
            $table->unsignedBigInteger('monitordelivery_id')->nullable();//quien entrega room monitor
            $table->unsignedBigInteger('monitorreceives_id')->nullable();//quien recibe room monitor

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('production_details_connec_id')->references('id')->on('production_details_connec')->onDelete('cascade');
            $table->foreign('monitordelivery_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('monitorreceives_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_shifts');
        Schema::dropIfExists('account_production_details');
        // Schema::dropIfExists('production_has_accounts');
        Schema::dropIfExists('production_details_connection');
        Schema::dropIfExists('production_details_shift');
        Schema::dropIfExists('planning_provider');
        Schema::dropIfExists('monitor_shifts');
        Schema::dropIfExists('production_details_day');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('shift_has_planning');
        Schema::dropIfExists('audits');
        Schema::dropIfExists('production_masters');
        Schema::dropIfExists('commissions');
    }
}
