<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class ContractController extends ApiController
{
   
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');
    }
    
    // public function index()
    // {
    //     // $breadcrumbs = [
    //     //     ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de Contract"]
    //     // ];

    //     // // $contracts = Contract::orderBy('id','DESC');   
    //     // // $contracts = Contract::orderBy('id','ASC')->pluck('number', 'location', 'id');
    //     // $contracts= Contract::orderBy('id','DESC')->get();
          
    //     // $data = ['data'=>$contracts, 'breadcrumbs'=> $breadcrumbs];
    //     // return $this->showAll($data);

    // }

    public function store(Request $request)
    {

        if ($request->file('image')) {
            $file = $request->file('image');
            $name = 'Contract_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\Contract';
            $file->move($path, $name);
  
          }

          $contract = Contract::find($request->contract_id);
          $contract->status = 1;
          $contract->save();

          $image = new Image();
          $image->name = $name;
          $image->save();

          $image->Contract()->attach($contract->id);

          $data = ['data'=>$contract, 'image'=> $image];

         return $this->showOne($data, 201);

    }

    public function show(Contract $contract) // debes pedir el tipo de contrato y el usuario o hacer un metodo porque guardo los 6 tipos para verificar cual pide y si existe la imagen
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver Contract"]
        ];

        // $pdf = PDF::loadView('pdf.contractRepreAr', compact('user','expedida'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

        // return $pdf->download('contrato-tipo-1.pdf');

        if ($contract->status == 1 ) {

            $contract->images;

            $data = ['data'=>$contract, 'breadcrumbs'=> $breadcrumbs];
            return $this->showOne($data);

        } elseif ($contract->contract_type == 1) {
            
            $pdf = PDF::loadView('pdf.contractRepreAr', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-1.pdf');

        } elseif ($contract->contract_type == 2) {
            
            $pdf = PDF::loadView('pdf.contractSateStu', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-2.pdf');

        } elseif ($contract->contract_type == 3) {

            $pdf = PDF::loadView('pdf.contractInven', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-3.pdf');

        } elseif ($contract->contract_type == 4) {

            $pdf = PDF::loadView('pdf.contractDereIm', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-4.pdf');

        } elseif ($contract->contract_type == 5) {

            $pdf = PDF::loadView('pdf.contractSubEst', compact('contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-5.pdf');

        } elseif ($contract->contract_type == 6) {

            $pdf = PDF::loadView('pdf.contractTermFijo', compact( 'contract'));//TODO: tomar en cuenta que puede tener varias ganacias recorrer y mostrar global

            return $pdf->download('contrato-tipo-6.pdf');

        }
       

        // $data = ['data'=>$contract, 'breadcrumbs'=> $breadcrumbs];
        // return $this->showOne($data);
    }

    public function update(Request $request, Contract $contract)
    {

        $contract->fill($request->all())->save();
        $contract->images;
        
        $data = ['data'=>$contract];
        return $this->showOne($data);
    }

    // public function destroy(Contract $contract)
    // {
    //     $contract->delete($contract);
    //     return $this->showOne($contract);
    // }

    public function updateImage(Request $request, Contract $contract)//Request $request
    {

        $image = Contract::find($request->image_id);

        if ($request->file('image')) {

            foreach ($contract->images as $image) {
                $image->Contract()->detach($contract->id);
    
            }

            $image_path = public_path().'/images/img_app/Contract/'.$image->name;
            unlink($image_path);
            $image->delete($image);

            $file = $request->file('image');
            $name = 'Contract'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\img_app\Contract';
            $file->move($path, $name);
  
            $image = new Image();
            $image->name = $name;
            $image->save();
  
            $image->Contract()->sync($contract->id);

          }

        $contract->images;
        
        $data = ['data'=>$contract];
        return $this->showOne($data);
    }
}
