<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique()->nullable();
            $table->string('nit')->unique();            
            $table->string('name');
            $table->date('fundation')->nullable();
            $table->text('address');
            $table->text('description');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            $table->string('name_owner')->nullable();
            $table->string('last_name_owner')->nullable();
            $table->string('document_number')->nullable();
            $table->string('enrollment')->nullable();
            $table->string('Trade')->nullable();

            $table->unsignedBigInteger('companytype_id');
            $table->unsignedBigInteger('company_id')->nullable();
            // $table->bigInteger('referrer_companies_id')->nullable();
                        
            $table->softDeletes();
            $table->timestamps();

            
            $table->foreign('companytype_id')->references('id')->on('company_types')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });


      


        // Schema::create('clients_has_companies', function (Blueprint $table) {
        //     $table->bigIncrements('id');
            

        //     $table->unsignedBigInteger('company_id')->unsigned();
        //     $table->unsignedBigInteger('client_id')->unsigned();
                        
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        //     $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        // });

        Schema::create('company_person', function (Blueprint $table) {
            $table->bigIncrements('id');
            

            $table->unsignedBigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('person_id')->unsigned();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->BigInteger('number_control')->default(0);

            $table->unsignedBigInteger('company_id')->unsigned();
                        
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        
        // Schema::create('bills_to_charge_shops', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->text('description');
        //     $table->enum('way_to_pay',['cash','credit','transfer']);
        //     $table->string('transfer_code');
        //     $table->bigInteger('bills_to_charge_credit_id')->nullable();
        //     $table->float('paid');
        //     $table->float('total_paid');
        //     $table->float('cost');
        //     $table->bigInteger('quantity');
        //     $table->float('total_cost');

        //     $table->unsignedBigInteger('employees_id')->unsigned();//vendedor
        //     $table->unsignedBigInteger('clients_id')->unsigned();//cliente

        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('employees_id')->references('id')->on('employees')->onDelete('cascade');
        //     $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        // Schema::dropIfExists('bills_to_charge_shops');
        Schema::dropIfExists('shop');
        // Schema::dropIfExists('training_has_companies');
        Schema::dropIfExists('company_person');
        // Schema::dropIfExists('clients_has_companies');
        Schema::dropIfExists('companies');
    }
}
