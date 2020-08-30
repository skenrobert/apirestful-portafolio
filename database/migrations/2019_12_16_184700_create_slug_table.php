<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('contacts', function(Blueprint $table)
            {
                $table->string('slug')->unique();
            });//

            Schema::table('users', function(Blueprint $table)
            {
                // $table->string('slug')->unique()->nullable();
                $table->string('slug')->nullable();
            });//

            Schema::table('companies', function(Blueprint $table)
             {
                $table-> string('slug')->nullable();
            });

             Schema::table('categories', function(Blueprint $table)
             {
                 $table-> string('slug')->nullable();
             });

            Schema::table('people', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('employees', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            // Schema::table('clients', function(Blueprint $table)
            // {
            //     $table-> string('slug')->nullable();
            // });


            Schema::table('trainings', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('lockers', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('payroll', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
  
            });

            Schema::table('bill_to_pays', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('bill_to_charges', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('production_masters', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('providers', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('inventories', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('accountings', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('projects', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('audiovisuals', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('sites', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('items', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('shifts', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('boutiques', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('banks', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('epss', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });

            Schema::table('purchase_orders', function(Blueprint $table)
            {
                $table-> string('slug')->nullable();
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('slug');


        Schema::table('users', function(Blueprint $table)
          {
              $table->dropColumn('slug');
          });//

           Schema::table('companies', function(Blueprint $table)
           {
               $table->dropColumn('slug');
           });

           Schema::table('categories', function(Blueprint $table)
           {
            $table->dropColumn('slug');

           });

          Schema::table('people', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('employees', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          // Schema::table('clients', function(Blueprint $table)
          // {
          //   $table->dropColumn('slug');

          // });


          Schema::table('trainings', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('lockers', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('payroll', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('bill_to_pays', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('bill_to_charges', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          // Schema::table('productions', function(Blueprint $table)
          // {
          //   $table->dropColumn('slug');

          // });

          Schema::table('providers', function(Blueprint $table)
            {
                $table->dropColumn('slug');
            });

          Schema::table('inventories', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('accountings', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('projects', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('audiovisuals', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('sites', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('items', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('shifts', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('boutiques', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('banks', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('epss', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });

          Schema::table('purchase_orders', function(Blueprint $table)
          {
            $table->dropColumn('slug');

          });


    }
}
