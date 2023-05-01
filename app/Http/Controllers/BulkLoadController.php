<?php

namespace App\Http\Controllers;

use App\Models\BulkLoad;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ModelsImport;
use App\Exports\ModelsExport;

class BulkLoadController extends ApiController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware('MonologMiddleware');
    }
    
    public function index()
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Lista de BulkLoad"]
        ];

        $bulkload = BulkLoad::orderBy('id','ASC')
        ->whereNull('document_number')
        // ->with('Provider')
        ->orderBy('id','DESC')
        ->get()
        // ->pluck('Provider')
        ->unique()
        ->values()
        ->each->delete();
        
        $bulkloads= BulkLoad::orderBy('id','DESC')->get();
          
        $data = ['data'=>$bulkloads, 'breadcrumbs'=> $breadcrumbs];
        return $this->showAll($data);

    }

    public function store(Request $request)
    {
        // $bulkload = BulkLoad::create($request->all());
        // return $this->showOne($bulkload, 201);
    }

    public function show(BulkLoad $bulkload)
    {
        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=>"Ver BulkLoad"]
        ];

        $data = ['data'=>$bulkload, 'breadcrumbs'=> $breadcrumbs];
        return $this->showOne($data);
    }

    public function update(Request $request, BulkLoad $bulkload)
    {
        // $bulkload->fill($request->all())->save();
        // return $this->showOne($bulkload);
    }

    public function destroy(BulkLoad $bulkload)
    {
        // $bulkload->delete($bulkload);
        // return $this->showOne($bulkload);
    }

    public function importExcel(Request $request)
    {

        if (BulkLoad::find(1)) {

              $bulkload = BulkLoad::orderBy('id','ASC')
                    // ->whereNull('document_number')
                    // ->with('Provider')
                    ->orderBy('id','DESC')
                    ->get()
                    // ->pluck('Provider')
                    ->unique()
                    ->values()
                    ->each->delete();

                    $file = $request->file('file');
                    Excel::import(new ModelsImport, $file);

                    return $this->showOne($request);

        }else {

                //         $path1 = $request->file('mcafile')->store('temp'); 
                // $path=storage_path('app').'/'.$path1;  
                // $data = \Excel::import(new UsersImport,$path);
                    $file = $request->file('file');
                    Excel::import(new ModelsImport, $file);
                    
                return $this->showOne($request);

        }
        

    }

    public function exportExcel(Request $request)
    {
    //    $file = $request->file('file');
    //    Excel::import(new ModelsImport, $file);
       
        return Excel::download(new ModelsExport, 'models-list.csv');
    }

    public function exportPDF(Request $request)
    {
    //    $file = $request->file('file');
    //    Excel::import(new ModelsImport, $file);
       
        return Excel::download(new ModelsExport, 'models-list.pdf');
    }

}
