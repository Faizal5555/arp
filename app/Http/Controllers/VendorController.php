<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Country;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorExport;
use App\Imports\VendorImport;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $userType=auth()->user()->user_type;
         if($userType=="admin"){
             $vendor = Vendor::latest();
         }else{
             $vendor = Vendor::where('user_id',auth()->user()->id)->latest();
         }
       
       if ($request->ajax()) {
       return Datatables::of($vendor->orderBy('id','Desc')->get())
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
       }
        return view('vendor.index', compact('vendor'));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor="";
        $country = Country::get();
        $client = Client::get();
        // dd($country);
        return view('vendor.create',compact('vendor','country','client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validator = Validator::make(
            $req->all(),
            ['vendor_name'=>'required',
             'vendor_country'=>'required',
             'vendor_email'=>'required|email|unique:vendor,vendor_email',
             'vendor_manager'=>'required',
             'vendor_phoneno'=>'required',
             'vendor_whatsapp'=>'required'
                ]
        );

        if (!$validator->fails()) {
            $vendor = new Vendor();
            $vendor->vendor_name = $req->vendor_name;
            $vendor->vendor_country = $req->vendor_country;
            // $vendor->client_id = $req->client_id;
            $vendor->vendor_email = $req->vendor_email;
            $vendor->vendor_manager = $req->vendor_manager;
            $vendor->vendor_phoneno = $req->vendor_phoneno;
            $vendor->vendor_whatsapp = $req->vendor_whatsapp;
            $vendor->user_id = auth()->user()->id;

            if ($vendor->save()) {
                $response_data = ["success" => 1, "message" => "Vendor Created Successfully"];
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }

        return response()->json($response_data);
    }

    public function edit($id)

    {
      

       
        $country = Country::get();
        $client = Client::get();
    
        $vendor = Vendor::where('id', $id)->first();

        
     
       

        return view('vendor.edit', compact('vendor','country','client'));
    }

    public function update(Request $req)
    {
        $v = $req->all();

        $validator = Validator::make(
            $v,
            []
        );

        if (!$validator->fails()) {
            $vendor = Vendor::where('id', $req->id)->first();
            $vendor->vendor_name = $req->vendor_name;
            $vendor->vendor_country = $req->vendor_country;
            $vendor->vendor_email = $req->vendor_email;
            $vendor->vendor_manager = $req->vendor_manager;
            $vendor->vendor_phoneno = $req->vendor_phoneno;
            $vendor->vendor_whatsapp = $req->vendor_whatsapp;
            $vendor->user_id = auth()->user()->id;

            if ($vendor->save()) {
                $response_data = ["success" => 1, "message" => "Vendor Updated Successfully"];
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }

        return response()->json($response_data);
    }

    public function delete(Request $req,$id)
    {
        //  $id=$req->data;

        $school= Vendor::where('id',$id)->delete();

        if($school)
        {
            $response_data = ["success" => 1, "message" => "Client Deleted Successfully"];

            return redirect()->route('vendor.index');

        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }

        return response()->json($response_data);
    }
    public function export() 
    {
        return Excel::download(new VendorExport, 'vendor.xlsx');
    }

    public function importview()
    {
        return view('vendor.index');
    }

    public function import() 
    {
        if(!empty(request()->file('file'))){
        Excel::import(new VendorImport,request()->file('file'));
        return back()->with('success', 'Imported Successfully');
        }
        else{
           return back()->with('fail', 'please import file');  
        }
    }

    
 


}

