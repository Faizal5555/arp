<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Exports\ClientExport;
use App\Imports\ClientImport;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\ValidationException;

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
        // Validate basic input fields
        $validator = Validator::make($req->all(), [
            'client_name' => 'required',
            'client_country' => 'required',
            'client_email' => 'required|email',
            'client_manager' => 'required',
            'client_phoneno' => 'required|numeric|digits_between:9,15',
            'client_whatsapp' => 'required|numeric|digits_between:9,15',
        ]);
    
        // If validation fails
        if ($validator->fails()) {
            return response()->json([
                "success" => 0,
                "message" => "Validation Error",
                "error" => $validator->errors()
            ]);
        }
    
        // Check if email already exists
        if (Client::where('client_email', $req->client_email)->exists()) {
            return response()->json([
                "success" => 0,
                "message" => "The email address is already registered."
            ]);
        }
    
        // Check if phone number already exists
        if (Client::where('client_phoneno', $req->client_phoneno)->exists()) {
            return response()->json([
                "success" => 0,
                "message" => "The phone number is already registered."
            ]);
        }

        if (Client::where('client_whatsapp', $req->client_whatsapp)->exists()) {
            return response()->json([
                "success" => 0,
                "message" => "The whatsapp number is already registered."
            ]);
        }
    
        // If no duplicates, proceed to save the client
        $client = new Client();
        $client->client_name = $req->client_name;
        $client->client_country = $req->client_country;
        $client->client_email = $req->client_email;
        $client->client_manager = $req->client_manager;
        $client->client_phoneno = $req->client_phoneno;
        $client->client_whatsapp = $req->client_whatsapp;
        $client->user_id = auth()->user()->id;
    
        if ($client->save()) {
            return response()->json([
                "success" => 1,
                "message" => "Client Created Successfully"
            ]);
        } else {
            return response()->json([
                "success" => 0,
                "message" => "An error occurred while saving the client."
            ]);
        }
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
        // Validate other fields
        $validator = Validator::make($req->all(), [
            'client_name' => 'required',
            'client_country' => 'required',
            'client_email' => 'required|email',
            'client_manager' => 'required',
            'client_phoneno' => 'required|numeric|digits_between:9,15',
            'client_whatsapp' => 'required|numeric|digits_between:9,15',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "success" => 0,
                "message" => "Validation Error",
                "error" => $validator->errors(),
            ]);
        }
    
        // Check if the email already exists in another record
        $emailExists = Client::where('client_email', $req->client_email)
            ->where('id', '!=', $req->id) // Exclude the current record by ID
            ->exists();
    
        if ($emailExists) {
            return response()->json([
                "success" => 0,
                "message" => "The email ID already exists.",
            ]);
        }
    
        // Check if the phone number already exists in another record
        $phoneExists = Client::where('client_phoneno', $req->client_phoneno)
            ->where('id', '!=', $req->id) // Exclude the current record by ID
            ->exists();
    
        if ($phoneExists) {
            return response()->json([
                "success" => 0,
                "message" => "The phone number already exists.",
            ]);
        }

        $whatsappExists = Client::where('client_phoneno', $req->client_whatsapp)
        ->where('id', '!=', $req->id) // Exclude the current record by ID
        ->exists();

    if ($whatsappExists) {
        return response()->json([
            "success" => 0,
            "message" => "The whatsapp number already exists.",
        ]);
    }
    
        // Update the client record
        $client = Client::find($req->id);
        if (!$client) {
            return response()->json([
                "success" => 0,
                "message" => "Client not found.",
            ]);
        }
    
        $client->client_name = $req->client_name;
        $client->client_country = $req->client_country;
        $client->client_email = $req->client_email;
        $client->client_manager = $req->client_manager;
        $client->client_phoneno = $req->client_phoneno;
        $client->client_whatsapp = $req->client_whatsapp;
        $client->user_id = auth()->user()->id;
    
        if ($client->save()) {
            return response()->json([
                "success" => 1,
                "message" => "Client updated successfully.",
            ]);
        } else {
            return response()->json([
                "success" => 0,
                "message" => "Site server error.",
            ]);
        }
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

    // public function import() 
    // {
    //     $user = Auth::user();
    //     if(!empty(request()->file('file'))){
    //     Excel::import(new ClientImport,request()->file('file'));
    //     return back()->with('success', 'Imported Successfully');
    //     }
    //     else{
    //        return back()->with('fail', 'Already Used');  
    //     }
             
      
    // }

    public function import()
{
    try {
        Excel::import(new ClientImport, request()->file('file'));
        return back()->with('success', 'Imported Successfully');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();

        $errors = [];
        foreach ($failures as $failure) {
            $row = $failure->row(); // Row number
            $attribute = $failure->attribute(); // Column name
            $errors[] = "Row $row, Column '$attribute': " . implode(', ', $failure->errors());
        }

        return back()->withErrors(['import_errors' => $errors]);
    }
}

public function downloadclientSampleFile()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers
    $headers = [
        'client_name', 'client_country', 'client_email', 
        'client_manager', 'client_phoneno', 'client_whatsapp'
    ];
    foreach ($headers as $index => $header) {
        $sheet->setCellValueByColumnAndRow($index + 1, 1, $header);
    }

    // Add sample data
    $sheet->fromArray([
        ['example', 'India', 'example123@gmail.com', 'test', '97846548498', '53333333311'],
    ], null, 'A2');

    // Save the file and download it
    $filePath = public_path('assets/sample-client-file.xlsx');
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    return response()->download($filePath)->deleteFileAfterSend(false);
}



}

