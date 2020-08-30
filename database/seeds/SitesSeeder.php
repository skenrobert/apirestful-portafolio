<?php

use Illuminate\Database\Seeder;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
   
        $name[1]= 'Chaturbate';
        $url[1]= 'https://es.chaturbate.com/';
        $pay[1]= 'Tokens';
        $token_value[1]= '0.05';
        
 
        $name[2]= 'Cam4';
        $url[2]= 'https://www.cam4.es/chicas';
        $pay[2]= 'Tokens';
        $token_value[2]= '0.1';
 
        $name[3]= 'MyFreeCams';
        $url[3]= 'https://m.myfreecams.com/models';
        $pay[3]= 'Tokens';
        $token_value[3]= '0.05';

        $name[4]= 'Stripchat';;
        $url[4]= 'https://es.stripchat.com/';
        $pay[4]= 'Tokens';
        $token_value[4]= '0.05';

        $name[5]= 'Camsoda';;
        $url[5]= 'https://es.camsoda.com/';
        $pay[5]= 'Tokens';
        $token_value[5]= '0.045';

        $name[6]= 'LiveJasmin';;
        $url[6]= 'https://modelcenter.livejasmin.com/es/';
        $pay[6]= 'Dolares';
        $token_value[6]= '0.1';

        $name[7]= 'Streamate';
        $url[7]= 'https://www.streamate.com/';      
        $pay[7]= 'Dolares';
        $token_value[7]= '0.1';

        $name[8]= 'Bongacams';
        $url[8]= 'https://es.bongacams.com/';       
        $pay[8]= 'Dolares';
        $token_value[8]= '0.025';
        

        for ($i=1;$i<=8; $i++){
            
            DB::table('sites')->insert([

                'id' => $i,
                'name' => $name[$i],
                'url' => $url[$i],
                'pay' => $pay[$i],
                'token_value' => $token_value[$i],
                'created_at'=> now(),
                'updated_at'=> now(),

            ]);

        }

    }//fin metodo run
}
