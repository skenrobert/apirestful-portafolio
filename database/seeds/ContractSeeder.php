<?php

use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    public function run()// EN teoria no se necesita un Modulo para estado ya que son constantes
    {

        // 1 = Alerta / 2 = Asignacion / 3 = Deduccion / 5 = Permiso
        $id[1] = 1;
        $name[1] = 'MARIA JULIANA';
        $last_name[1] = 'SPADEI TORRES' ;
        $document_type[1] = 'C.C';
        $document_number[1] = '1.000.329.756';
        $issued[1] = 'Bogota';
        $address[1] = 'Calle 10 No 12-35, Barrio La Esperanza en Florida';
        $email[1] = 'Mariajuli1999@gmail.com';
        $mobile_phone[1] = '320-4315271';
        $percentage_MANDATARIO[1] = '20%';
        $percentage_MANDANTE[1] = '80% ';
        $couple_name[1] = 'JAVIER CELIS HOLGUIN';
        $document_type_couple[1] = 'CC';
        $document_number_couple[1] = '1.144.209.607';
        $percentage_number[1] = '70%';
        $percentage[1] = 'setenta por ciento';
        $valor[1] = '$3.500.000.00';
        $equipment[1] = '(Modelo OPTIPLEX 3040; Marca JANUS; Serial 4Z4XGB2; Procesador CORE I5 10W -6700T CPU @2.8; Ram 16 GB; Disco 120 GB; MAC RED 64-00-6 A-70-89-3C; BOARD GOLDEN; Licencia WINDOWS 7JJNK-BJ7TK-8F77G-VQ733-DV7CP; Sistema W 10 PRO-64Bits; Modelo BOARD N/A);' ;
        $nationality[1] = 'CALI (V) , 19 DE  MARZO DE 2.000, COLOMBIANO';
        $position[1] = 'MONITOR';
        $salary[1] = '$828.116' ;
        $salary_written[1] = 'OCHOCIENTOS VEINTIOCHO MIL CIENTO DIECISEIS PESOS  MCTE., ($828.116,oo) pesos mcte' ;
        $start_date[1] = 'CALI JULIO  01 DEL 2019' ;
        $end_date[1] = 'CALI  JUNIO  30 DEL 2020';
        $function[1] = 'a)- Todas y cada una de las funciones determinadas en el manual correspondiente adjunto, que hace parte integral de este contrato. b)- Brindar soporte y acompañamiento instructivo al personal (modelos) etc.';
        $payment_period[1] = 'QUINCENAL';
        $duration[1] = 'una duración de 12 meses';
        $finished[1] = 'CONTRATO  INDIVIDUAL DE TRABAJO A  TÉRMINO FIJO DE UN AÑO' ;
        // $subStudy_id[1] = 2;
        $user_id[1] = 1;
        $company_id[1] = 1;
        
        for ($i=1;$i<2; $i++){
            
            DB::table('contracts')->insert([

                'id' => $i,
                'name' => $name[1],
                'last_name' => $last_name[1],
                'document_type' => $document_type[1],
                'document_number' => $document_number[1],
                'issued' => $issued[1],
                'address' => $address[1],
                'email' => $email[1],
                'mobile_phone' => $mobile_phone[1],
                'percentage_mandatario' => $percentage_MANDATARIO[1],
                'percentage_mandante' => $percentage_MANDANTE[1],
                'couple_name' => $couple_name[1],
                'document_type_couple' => $document_type_couple[1],
                'document_number_couple' => $document_number_couple[1],
                'percentage_number' => $percentage_number[1],
                'percentage' => $percentage[1],
                'valor' => $valor[1],
                'equipment' => $equipment[1],
                'nationality' => $nationality[1],
                'position' => $position[1],
                'salary' => $salary[1],
                'salary_written' => $salary_written[1],
                'start_date' => $start_date[1],
                'end_date' => $end_date[1],
                'function' => $function[1],
                'duration' => $duration[1],
                'finished' => $finished[1],
                // 'subStudy_id' => $subStudy_id[1],
                'user_id' => $user_id[1],
                'company_id' => $company_id[1],
                'contract_type' => 1,
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }

    }//fin metodo
}
