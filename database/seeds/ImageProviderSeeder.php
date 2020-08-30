<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provider;
use App\Models\Image;

use Faker\Generator as faker;


class ImageProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $providers = Provider::orderBy('id', 'ASC')->pluck('id')->all(); // se trae todo de la base de datos tabla People la ordena

        foreach($providers as $provider){
        
            $img = file_get_contents(__DIR__.'/../../public/images/profile/user-uploads'.'/user-'.'0'.rand(1, 9).'.jpg');//TODO no Conecta

            $fileName = str_random(5).'_'.'.jpg';
            $image = new Image();
            $image->name = $fileName;
    
            $image->save();
    
            $image->provider()->attach($provider);//se debe cambiar el metodo respectivamente con el modelo image y su respectivo metodo
    
            //Y la guardamos en el servidor.
            file_put_contents("public/images/img_app/provider/$fileName", $img);
    


            }

            
    }
}
