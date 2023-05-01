<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Accounting;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Shop;

class CompanyController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('MonologMiddleware');

    }
    
 
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Compañeas"]
        ];
     
        // $companies = Company::has('companytype')->get();
        $companies= Company::orderBy('id','DESC')->get();

        $companies->each(function($companies){
             $companies->companytype;
            $companies->images;
            $companies->referrer_companies;

          });

        $data = ['data'=>$companies, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $company = Company::create($request->all());

          if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'company_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\company';// la orientacion de los la son segun el sistema operativo donde este el sistema
            $file->move($path, $name);

            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->company()->attach($company->id);//se debe cambiar el metodo respectivamente con el modelo image y su respectivo metodo
  
          }

         
        $accounting = new Accounting();
        $accounting->company_id = $company->id;
        $accounting->save();

        $shops = new Shop();
        $shops->company_id = $company->id;
        $shops->save();
        
        $inventory = new Inventory();
        $inventory->shop_id = $shop->id;
        $inventory->save();

        $shop->inventory;

        $company->accounting;


        $data = ['data'=>$company];
        return $this->showOne($data, 201);

    }

    public function show(Company $company)
    {
               
        $company->images;
        $company->companytype;
        $company->referrer_companies;
        $data = ['data'=>$company];
        return $this->showOne($data);
    }

    public function update(Request $request, Company $company)
    {

        $company->fill($request->all())->save();

        $data = ['data'=>$company];
        return $this->showOne($data);
    }

    public function destroy(Company $company)
    {
        // $company->delete($company);
        // return $this->showOne($company);
    }

    public function updateImage(Request $request, Company $company)//Request $request
    {

        $image = Image::find($request->image_id);

        if ($request->file('image')) {

            // foreach ($company->images as $image) {
            //     $image->company()->detach($company->id);
            // }

            $image_path = public_path().'/images/img_app/company/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'company'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\company';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->company()->sync($company->id);

          }

        $company->images;
        
        $data = ['data'=>$company];
        return $this->showOne($data);
    }
}
