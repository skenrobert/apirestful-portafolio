<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->truncateTable([
                'providers','people','employees','images','users','rooms','lockers'
        ]);

  
        // User::truncate();
        // User::flushEventListeners();

        $this->call(ContactSeeder::class);
        $this->call(CompanyTypeSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EventTypeSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(SitesSeeder::class);
        $this->call(JobTypeSeeder::class);

        $this->call(BankSeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(LockerSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(AudiovisualSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EpsSeeder::class);
        // $this->call(ShiftHasEmployeesSeeder::class);
        // $this->call(ShiftHasProviderSeeder::class);
        $this->call(ShiftHasPlanningSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(MonitorShiftSeeder::class);
        $this->call(PlanningProviderSeeder::class);

        $this->call(CommissionSeeder::class);
        $this->call(ProductionMasterSeeder::class);
        $this->call(CompareProviderWeekSeeder::class);

        $this->call(ProductionDetailsDaySeeder::class);
        $this->call(ProductionDetailsShiftSeeder::class);
        $this->call(ProductionDetailsConnecSeeder::class);
        $this->call(AccountProductionDetailsSeeder::class);

        $this->call(AccountRequestSeeder::class);
        $this->call(AccountPlanSeeder::class);

        $this->call(BoutiqueSeeder::class);

        $this->call(AuditShiftSeeder::class);

        $this->call(ImageProviderSeeder::class);

        $this->call(MovementTypeSeeder::class);

        $this->call(TaxSeeder::class);

        $this->call(ItemSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ShopSeeder::class);

        $this->call(InventorySeeder::class);

        $this->call(TypeMovementInventorySeeder::class);

        $this->call(AccountingSeeder::class);
 
        $this->call(BillToChargeSeeder::class);
        $this->call(ClientHasPaymentSeeder::class);


        $this->call(PayrollSeeder::class);

        $this->call(ReceiptPaymentSeeder::class);

        $this->call(BillToPaySeeder::class);
        $this->call(PayOrderSeeder::class);


        $this->call(SheduleSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(RecordSeeder::class);
        $this->call(TrainingSeeder::class);

        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);

        $this->call(SaleInvoiceSeeder::class);
        $this->call(ComissionEmployeeSeeder::class);
        $this->call(ComissionModelSeeder::class);
        $this->call(ComissionStudySeeder::class);
        $this->call(AccountReceiptProviderSeeder::class);

        $this->call(ContractSeeder::class);
        
    }

    protected function truncateTable(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach($tables as $table){
            DB::table($table)->truncate();

        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        
    }
}
