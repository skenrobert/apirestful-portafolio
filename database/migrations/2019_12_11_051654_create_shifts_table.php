<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->time('start');
            $table->time('end');
            $table->bigInteger('break');

            $table->softDeletes();
            $table->timestamps();
        }); 

        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');    

            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
        
        // Schema::create('shift_has_employees', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->boolean('confirmed')->default(1);
        //     $table->enum('status',['planing','present','past']);
        //     $table->text('description');
        //     $table->date('beginning_week');//planinng
        //     $table->date('end_week');
        //     // $table->json('monitors');//TODO: si es administrativo esto es vacio
        //     // $table->json('support');//TODO: monitores de respaldo (debe poder ver las claves de las modelos de los monitores principales de esa semana)

        //     $table->unsignedBigInteger('shifts_id');   
        //     $table->unsignedBigInteger('support_id');
        //     $table->unsignedBigInteger('productiondetailsdays_id')->nullable();
            
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('shifts_id')->references('id')->on('shifts')->onDelete('cascade');
        //     $table->foreign('support_id')->references('id')->on('employees')->onDelete('cascade');
        //     $table->foreign('productiondetailsdays_id')->references('id')->on('production_details_days')->onDelete('cascade');
        
        // });

        // Schema::create('monitors_shift', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->text('observation');       
            
        //     $table->unsignedBigInteger('shifthasemployees_id')->unsigned();   
        //     $table->unsignedBigInteger('monitor_id')->unsigned();   
        //     $table->unsignedBigInteger('task_id')->unsigned()->nullable();

        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('shifthasemployees_id')->references('id')->on('shift_has_employees')->onDelete('cascade');
        //     $table->foreign('monitor_id')->references('id')->on('employees')->onDelete('cascade');
        //     $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        // });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('monitors_shift');
        // Schema::dropIfExists('shift_has_employees');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('shifts');
    }
}
