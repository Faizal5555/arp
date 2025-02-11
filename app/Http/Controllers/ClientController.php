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
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exports\ClientExport;
use App\Imports\ClientImport;
use App\Imports\ClientDataImport;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\ValidationException;
use App\Models\ClientData;

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
            
       
        //dd($client);
      
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

    public function clientdata(Request $request)
    {
        return view('client.data');
    }


    public function fetchClientData(Request $request)
    {
        $user = Auth::user();
        $query = ($user->user_type == 'admin') 
        ? ClientData::query() 
        : ClientData::where('user_id', $user->id);

        // $query = ClientData::where('user_id', $user->id);

    // Apply Status Filter
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    if ($request->has('company_name') && !empty($request->company_name)) {
        $query->where('company_name', 'LIKE', "%{$request->company_name}%");
    }

    // Apply Country Filter
    if ($request->has('client_country') && !empty($request->client_country)) {
        $query->where('client_country', 'LIKE', "%{$request->client_country}%");
    }

    return Datatables::of($query->orderBy('id', 'Asc'))->make(true);
    }

    public function getClientDetails($id)
    {
    $client = ClientData::findOrFail($id);
    return response()->json($client);
    }

    public function updateClientDetails(Request $request)
    {
    $client = ClientData::findOrFail($request->client_id);
    $client->update([
        'comments' => $request->comments,
        'status' => $request->status, // Update Status
        'followup_date' => $request->followup_date,
    ]);
    return response()->json(['message' => 'Updated Successfully']);
    }


    public function generateClientdataSampleFile()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Define headers including 'status' column
        $headers = [
            'A1' => 'sr_no',
            'B1' => 'company_name',
            'C1' => 'client_firstname',
            'D1' => 'client_lastname',
            'E1' => 'title',
            'F1' => 'linkedin_id',
            'G1' => 'client_country',
            'H1' => 'phone_number',
            'I1' => 'email_address',
            'J1' => 'status',
        ];
    
        // Apply headers
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
    
        // Sample data with 'status' column
        $sampleData = [
            [1, 'Tech Solutions Ltd', 'John', 'Doe', 'Manager', 'https://linkedin.com/johndoe', 'USA', '1234567890', 'johndoe@example.com', 'Client'],
            [2, 'Global Corp', 'Jane', 'Smith', 'CEO', 'https://linkedin.com/janesmith', 'UK', '9876543210', 'janesmith@example.com', 'Client'],
        ];
    
        // Populate sample rows
        $rowIndex = 2;
        foreach ($sampleData as $row) {
            $colIndex = 'A';
            foreach ($row as $cellValue) {
                $sheet->setCellValue($colIndex . $rowIndex, $cellValue);
                $colIndex++;
            }
            $rowIndex++;
        }
    
        // Apply dropdown validation to "status" column (J2:J100)
        $this->applyDropdownValidation($sheet, 2, 100);
    
        // Define file path
        $fileName = 'client-sample-file.xlsx';
        $filePath = public_path("assets/$fileName");
    
        // Save Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    
        // Return file for download
        return response()->download($filePath)->deleteFileAfterSend(false);
    }
    
    private function applyDropdownValidation(Worksheet $sheet, $startRow, $endRow)
    {
        for ($row = $startRow; $row <= $endRow; $row++) {
            $cell = "J$row";
            $validation = $sheet->getCell($cell)->getDataValidation();
            $validation->setType(DataValidation::TYPE_LIST);
            $validation->setErrorStyle(DataValidation::STYLE_STOP);
            $validation->setAllowBlank(false);
            $validation->setShowDropDown(true);
            $validation->setFormula1('"Client,Important,Normal,Not Responsive"'); // Dropdown options
            $sheet->getCell($cell)->setDataValidation($validation);
        }
    }
    
   public function clientdataimport(Request $request)
{   
    
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:2048', // Max 2MB
    ]);

    if (!$request->hasFile('file')) {
        return redirect()->back()->withErrors(['error' => 'No file uploaded']);
    }

    $file = $request->file('file');

    if (!$file->isValid()) {
        return redirect()->back()->withErrors(['error' => 'Invalid file upload']);
    }

    DB::beginTransaction();
    try {
        $data = Excel::toArray([], $file);
        // dd($data);
        \Log::info('Imported Data:', $data);
         
        // Ensure default status is "Client" if missing
        foreach ($data[0] as &$row) {
            if (!isset($row['status']) || empty(trim($row['status']))) {
                $row['status'] = 'Client';
            }
        }

        // Proceed with Import
        Excel::import(new ClientDataImport, $file, null, \Maatwebsite\Excel\Excel::XLSX);
        DB::commit();

        return redirect()->back()->with('success', 'Clients imported successfully!');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        DB::rollback();
        $failures = $e->failures();
        $validationErrors = [];

        foreach ($failures as $failure) {
            $row = $failure->row();
            $attribute = $failure->attribute();
            $errors = $failure->errors();
            foreach ($errors as $error) {
                $validationErrors[] = "Row {$row}, Column '{$attribute}': {$error}";
            }
        }

        return redirect()->back()->withErrors(['validationErrors' => $validationErrors])->withInput();
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}



        public function clientdataindex()
        {
            return view('client.clientdata');
        }

        public function filterClientData(Request $request)
        {   
            $user = Auth::user();
            // $query = ClientData::where('user_id', $user->id);

            $query = ($user->user_type == 'admin') 
            ? ClientData::query()  // Admin sees all records
            : ClientData::where('user_id', $user->id); // Normal user sees only their own
            
            //$query = ClientData::query();

            // Check if a date range is provided
            if (!empty($request->date_range)) {
                $dates = explode(' to ', $request->date_range);
                $startDate = $dates[0];
                $endDate = $dates[1];
        
                // Filter records based on Follow-up Date
                $query->whereBetween('followup_date', [$startDate, $endDate]);
            } else {
                // If no date is selected, return empty records
                $query->whereNull('id');
            }
        
            return DataTables::of($query)->make(true);
        }


}

