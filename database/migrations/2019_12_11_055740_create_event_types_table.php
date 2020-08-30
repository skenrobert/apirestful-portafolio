<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('event_types', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('value')->nullable();
            $table->string('type'); 
            $table->unsignedBigInteger('company_id');

            // 1 = Alerta / 2 = Asignacion / 3 = Deduccion / 4 = Permiso
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('events', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->text('observation');
            $table->boolean('processed')->default(0);// en true cuando el pago esta procesado
            $table->text('title')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->float('value_real')->nullable();
            
            $table->unsignedBigInteger('event_type_id')->unsigned()->nullable();
            $table->unsignedBigInteger('audit_shift_id')->unsigned()->nullable();
            $table->unsignedBigInteger('audit_id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//quien recibe Empleado
            $table->unsignedBigInteger('model_id')->unsigned()->nullable();//quien recibe Modelo
            $table->unsignedBigInteger('create_event_id')->unsigned()->nullable();//quien otorga
            $table->unsignedBigInteger('productiondetailsconnec_id')->unsigned()->nullable();
            $table->unsignedBigInteger('production_master_id')->unsigned()->nullable();
            $table->unsignedBigInteger('audiovisual_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('audiovisual_id')->references('id')->on('audiovisuals')->onDelete('cascade');
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->foreign('audit_shift_id')->references('id')->on('audit_shifts')->onDelete('cascade');
            $table->foreign('audit_id')->references('id')->on('audits')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('create_event_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('productiondetailsconnec_id')->references('id')->on('production_details_connec')->onDelete('cascade');
            $table->foreign('production_master_id')->references('id')->on('production_masters')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });   

        // Schema::create('events_production_masters', function (Blueprint $table) {//TODO: tratamiento diferente a la tabla relacion
        //     $table->bigIncrements('id');
        //     $table->text('observations');
        //     // $table->float('replacement_value');

        //     $table->unsignedBigInteger('event_id')->unsigned();
        //     $table->unsignedBigInteger('production_master_id')->unsigned();
                        
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        //     $table->foreign('production_master_id')->references('id')->on('production_masters')->onDelete('cascade');
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_types');
    }
}
