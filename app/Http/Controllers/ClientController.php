<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientExport;
use App\Imports\ClientImport;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
     public function index(Request $request)
    { 
       $userType=auth()->user()->user_type;
        if($userType=="admin"){
         $client=Client::latest();
       
        // dd($client);
      
        if ($request->ajax()) {

            
           
            return Datatables::of($client->orderBy('id','Desc')->get())
            
                    
                    ->make(true);
                    
        }  
        return view('client.index', compact('client'));
        }
        else{
             $userId=auth()->user()->id;
             $client=Client::where('user_id',$userId)->latest();
            
       
        // dd($client);
      
        if ($request->ajax()) {

            
           
            return Datatables::of($client->orderBy('id','Desc')->get())
            
                    
                    ->make(true);
                    
        }  
        return view('client.index', compact('client'));
        }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client="";
        $country = Country::get();
        return view('client.create',compact('client','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        

        $validator = Validator::make($req->all(),
    
            [   'client_name'=>'required',
                'client_country'=>'required',
                'client_email'=>'required|email|unique:client,client_email',
                'client_manager'=>'required',
                'client_phoneno'=>'required',
                'client_whatsapp'=>'required'
              
                ]);

        if (!$validator->fails()) {
            $client = new Client();
            $client->client_name = $req->client_name;
            $client->client_country = $req->client_country;
            $client->client_email = $req->client_email;
            $client->client_manager = $req->client_manager;
            $client->client_phoneno = $req->client_phoneno;
            $client->client_whatsapp = $req->client_whatsapp;
            $client->user_id = auth()->user()->id;

            if ($client->save()) {
                $response_data = ["success" => 1, "message" => "Client Created Successfully"];
              
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
       
        $user = Auth::user();
        $country = Country::get();
        $client = Client::where('id', $id)->first();
        return view('client.edit', compact('client','country'));

       
    }

    public function update(Request $req)
    {
        
        
        // dd($req->id);

        $validator = Validator::make($req->all(),
            [
                'client_name'=>'required',
                'client_country'=>'required',
                'client_email'=>'required|email',
                'client_manager'=>'required',
                'client_phoneno'=>'required',
                'client_whatsapp'=>'required'
                ]
        );

        if (!$validator->fails()) {
            
            $client = Client::where('id', $req->id)->first();
            // dd($client);
            $client->client_name = $req->client_name;
            $client->client_country = $req->client_country;
            $client->client_email = $req->client_email;
            $client->client_manager = $req->client_manager;
            $client->client_phoneno = $req->client_phoneno;
            $client->client_whatsapp = $req->client_whatsapp;
            $client->user_id = auth()->user()->id;
            
            if ($client->save()) {
                $response_data = ["success" => 1, "message" => "Client Updated Successfully"];

               
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
       // $id=$req->data;

        $school= Client::where('id',$id)->delete();

        if($school)
        {
            $response_data = ["success" => 1, "message" => "Client Deleted Successfully"];
            return redirect()->route('client.index');

        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }

        return response()->json($response_data);
    }
    public function export() 
    {
        return Excel::download(new ClientExport, 'client.xlsx');
    }

    public function importview()
    {
        return view('client.index');
    }

    public function import() 
    {
        $user = Auth::user();
        if(!empty(request()->file('file'))){
        Excel::import(new ClientImport,request()->file('file'));
        return back()->with('success', 'Imported Successfully');
        }
        else{
           return back()->with('fail', 'Already Used');  
        }
             
      
    }

}

