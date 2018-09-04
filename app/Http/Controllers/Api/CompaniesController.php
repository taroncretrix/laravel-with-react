<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompaniesCollection;
use App\Companies;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class CompaniesController extends Controller
{
    public function index() 
    {
        return new CompaniesCollection(Employees::all());
    }

    public function create(Request $request) 
    {
        $result = $request->all();

        $model = new Companies();
        $company = $request->all();
        $model->name = $company['name'];
        $model->email = $company['email'];
        $model->website = $company['website'];
        $path = $request['logo'];
        $path = Storage::putFile('logos', new File($path));
        $model->logo = $path;

        if($model->save() ) {
            return 'Company created successfully';   
        };
        return 'something went wrong';  
    }

    public function edit(Request $request, $id) 
    {
        $company = Employees::find($id);
        return response()->json([
            'data' => $company
        ]);
    }
    public function update(Request $request, $id) 
    {
        
         $result = $request->all();

         $model = Employees::find($id);
        $company = $request->all();
        $model->name = $company['firstName'];
        $model->email = $company['LastName'];
        $model->website = $company['company'];
       
        if($model->save() ) {
            return 'Employe Updated successfully';   
        };
        return 'something went wrong'; 
    }

    public function delete(Request $request, $id) 
    {
       $company = Employees::find($id); 
       $company->delete(); 
       return $id;
        
        
    }
}
