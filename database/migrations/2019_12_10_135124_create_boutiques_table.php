<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoutiquesTable extends Migration
{
    
    public function up()
    {
        Schema::create('boutiques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price');
            $table->string('name');
            $table->text('description');
            $table->string('code');
            $table->integer('status')->default(1);// [[ 0 = Ocupado | 1 = Disponible | 2 = Dañado ]]
            
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });



        Schema::create('boutique_provider', function (Blueprint $table) {//TODO: tratamiento diferente a la tabla relacion
            $table->bigIncrements('id');
            $table->text('observations');
            $table->float('replacement_value');

            $table->unsignedBigInteger('boutique_id')->unsigned();
            $table->unsignedBigInteger('provider_id')->unsigned();
            $table->unsignedBigInteger('monitor_id')->unsigned();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('boutique_id')->references('id')->on('boutiques')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('monitor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('boutique_provider');
        Schema::dropIfExists('boutique');
    }
}
