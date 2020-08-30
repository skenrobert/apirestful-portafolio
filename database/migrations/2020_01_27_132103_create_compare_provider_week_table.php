<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompareProviderWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('compare_provider_week', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('total_provider_week');//se basa en sacar la estimacion de toda la semana 
            $table->double('participation_current_week')->default(0);//tiene el porcentaje de comparacion con la semana anterior si es 0,0 es que es su primera semana

            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('production_master_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('production_master_id')->references('id')->on('production_masters')->onDelete('cascade');

        });
    }

    
    public function down()
    {
        Schema::dropIfExists('compare_provider_week');
        
    }
}
