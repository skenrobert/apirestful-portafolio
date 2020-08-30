<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->text('location');
            $table->integer('status')->default(1); // [[ 0 = Ocupado | 1 = Disponible | 2 = Mantenimiento ]]

            $table->unsignedBigInteger('company_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('locker_provider', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('locker_id')->unsigned();
            $table->unsignedBigInteger('provider_id')->unsigned();//quien recibe
            // $table->unsignedBigInteger('employees_id')->unsigned();//quien entrega
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('locker_id')->references('id')->on('lockers')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            // $table->foreign('employees_id')->references('id')->on('lockers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locker_provider');
        Schema::dropIfExists('lockers');
    }
}
