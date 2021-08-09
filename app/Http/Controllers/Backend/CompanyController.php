<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Company;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('backend.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefecture = Prefecture::all();
        $is_create = true;
        return view('backend.company.form', [
            'prefecture' => $prefecture,
            'is_create' => $is_create
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email' => 'required|email',
            'postcode' => 'required',
            'prefecture_id' => 'required',
            'city' => 'required',
            'local' => 'required',
            'image_file' => 'required|image'
        ]);
        $getNamePrefecture = $request->prefecture_id;
        $getIdPrefecture = Prefecture::select('id')->where('display_name', $getNamePrefecture)->first();
        $request->merge([
            'prefecture_id' => $getIdPrefecture->id,
        ]);
        // $request->prefecture_id = $getIdPrefecture->id;
        $company_id = Company::latest()->first();
        if($company_id){
            $last_id = $company_id->id + 1;
        } else{
            $last_id = 1;
        }

        $imageFirstName = 'Image_';
        $extImage = $request->image_file->extension();
        $imageFullName = $imageFirstName . $last_id . '.' . $extImage;
        //tambah request [image]
        $request['image'] = $imageFullName;
        

        $request->image_file->storeAs('public/upload/files', $imageFullName);
        
        $data = Company::create(
            $request->except([
                'image_file'
            ])
        );
        
        
        if($data){
            return redirect()->route('company.index')->with('success', 'Company successfully created');
        } else {
            return redirect()->route('company.index')->with('failed', 'Company fail created');
        }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prefecture = Prefecture::get();
        $company = Company::find($id);
        return view('backend.company.form', [
            'prefecture' => $prefecture,
            'company' => $company,
            'is_create' => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $company = Company::find($id);
        
        if($request->hasFile('image_file')){
            
            $imageFirstName = 'Image_';
            $extImage = $request->image_file->extension();
            $imageFullName = $imageFirstName . $id . '.' . $extImage;
            $request['image'] = $imageFullName;
            Storage::delete('public/uploads/files/' . $company->image);
            $request->image_file->storeAs('public/upload/files', $imageFullName);
            
            
        }
        $getNamePrefecture = $request->prefecture_id;
        $getIdPrefecture = Prefecture::select('id')->where('display_name', $getNamePrefecture)->first();
        $request->merge([
            'prefecture_id' => $getIdPrefecture->id,
        ]);
        $input = $request->except([
            'image_file'
        ]);
        $company->fill($input)->save();
        return redirect()->route('company.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $company = Company::find($request->get('id'));
            $company->delete();
            return redirect()->route('company.index')->with('success', 'Company successfully deleted');
        } catch(Exception $e) { 
            return redirect()->route('company.index')->with('failed', 'Company failed deleted');
        }
        
    }
}
