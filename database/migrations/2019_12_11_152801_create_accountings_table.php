<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->text('description');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('accountings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('inventory_id')->unsigned()->nullable();
            $table->unsignedBigInteger('payroll_id')->unsigned()->nullable();
            $table->unsignedBigInteger('account_plan_id')->unsigned()->nullable();
            $table->unsignedBigInteger('company_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_plan_id')->references('id')->on('account_plan')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });



        // Schema::create('bulk_load', function (Blueprint $table) {//TODO:posible tratamiento diferente por variable
        //     $table->bigIncrements('id');
        //     $table->string('CC')->unique();
        //     $table->integer('gender')->default(0); // 0 = Mujer | 1 = Pareja | 2 = Hombre | 3 = Trans
        //     $table->string('name');
        //     $table->string('mfc_nick');
        //     $table->string('chaturbarte_nick');
        //     $table->string('camsoda_nick');
        //     $table->string('stripchat_nick');
        //     $table->string('bongascam_nick');
        //     $table->string('cam4_nick');
        //     $table->string('jasmin_nick');
        //     $table->string('streamate_nick');
        //     $table->string('manyvids_nick');
        //     $table->string('youporn_nick');
        //     $table->string('naked_nick');
        //     $table->string('dirty_nick');
        //     $table->boolean('act_inact')->nullable();            
        //     $table->string('monitor');
        //     $table->boolean('time')->nullable();            
        //     $table->integer('location')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->integer('location_identify'); // 0 = Cédula | 1 = Pasaporte
        //     $table->string('bank_account')->nullable();
        //     $table->text('observation');
        //     $table->integer('tokens_min')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('us_min');
        //     $table->float('trm');

        //     $table->integer('mfc_tokens')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('mfc_us');
        //     $table->float('mfc_cc');

        //     $table->integer('chat')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('chat_us');
        //     $table->float('chat_cc');

        //     $table->integer('stripchat')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('stripchat_us');
        //     $table->float('stripchat_cc');

        //     $table->integer('camsoda')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('camsoda_us');
        //     $table->float('camsoda_cc');

        //     $table->integer('bongas')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     // $table->float('bongas_us');
        //     $table->float('bongas_cc');

        //     $table->integer('cam4')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     // $table->float('cam4_us');
        //     $table->float('cam4_cc');

        //     $table->integer('live_jasmin')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('live_jasmin_us');
        //     $table->float('live_jasmin_cc');

        //     $table->integer('live_streamate')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('live_streamate_us');
        //     $table->float('live_streamate_cc');

        //     // $table->integer('live_manyvids')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('live_manyvids_us');
        //     $table->float('live_manyvids_cc');

        //     // $table->integer('live_youporn')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('live_jyouporn_us');
        //     $table->float('live_youporn_cc');

        //     // $table->integer('live_naked')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('live_naked_us');
        //     $table->float('live_naked_cc');

        //     // $table->integer('dirty_naked')->default('0'); // 0 = Cédula | 1 = Pasaporte
        //     $table->float('dirty_naked_us');
        //     $table->float('dirty_naked_cc');

        //     $table->float('min_rate');
        //     $table->float('percentage_model');
        //     $table->float('ret/fte');
        //     $table->float('model_payment');
        //     $table->float('model_payment_us');
        //     $table->float('total_tokens');
        //     $table->float('average_week');
        //     $table->float('purchase_deductible');
        //     $table->float('fine_footprint');
        //     $table->float('late_connection_fine');
        //     $table->float('fine_english');
        //     $table->float('fine_makeup');
        //     $table->float('fine_sheets');
        //     $table->float('keyboard');
        //     $table->float('fine_social_media');
        //     $table->float('fine_others');
        //     $table->float('we_pay');
        //     $table->float('eps');
        //     $table->float('we_pay_deducctiones');
        //     $table->float('full_payment');
        //     $table->string('full_payment_ok');
        //     $table->float('prize');

        //     $table->unsignedBigInteger('accounting_id')->unsigned();

        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('accounting_id')->references('id')->on('accountings')->onDelete('cascade');

        // });

        Schema::create('bulk_load', function (Blueprint $table) {//TODO:posible tratamiento diferente por variable
            $table->bigIncrements('id');
            $table->string('document_number')->default('0')->nullable(); // 0 = Cédula | 1 = Pasaporte
            $table->string('name')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            
            $table->string('nickname_mfc')->nullable();
            $table->string('nickname_chat')->nullable();
            $table->string('nickname_stripchat')->nullable();
            $table->string('nickname_bongas')->nullable();
            $table->string('nickname_cam4')->nullable();
            $table->string('nickname_jasmin')->nullable();
            $table->string('nickname_streamate')->nullable();
            $table->string('nickname_manyvids')->nullable();
            $table->string('nickname_naked')->nullable();
            $table->string('nickname_youporn')->nullable();
            $table->string('nickname_dirty')->nullable();

            $table->string('token_mfc')->nullable();
            $table->string('token_chat')->nullable();
            $table->string('token_stripchat')->nullable();
            $table->string('token_camsoda')->nullable();
            $table->string('token_bongas')->nullable();
            $table->string('token_cam4')->nullable();
            $table->string('token_jasmin')->nullable();
            $table->string('token_streamate')->nullable();
            $table->string('token_manyvids')->nullable();
            $table->string('token_naked')->nullable();
            $table->string('token_youporn')->nullable();
            $table->string('token_dirty')->nullable();
            
            $table->unsignedBigInteger('accounting_id')->unsigned()->nullable();
            
            $table->foreign('accounting_id')->references('id')->on('accountings')->onDelete('cascade');
            
            // $table->softDeletes();
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
        Schema::dropIfExists('bulk_load');
        Schema::dropIfExists('account_plan');
        Schema::dropIfExists('accountings');
    }
}
