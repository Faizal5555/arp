<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Supplier;
use App\Models\supplieremailcontent;
use App\Events\SendSupplierMail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use App\Imports\SupplierImport;
use DB;
use App\Models\User;

class SupplierController extends Controller
{
    public function index(Request $request,Supplier $supplier){
       
        $user = Auth::user();
        $data=$request->all();
        $supplier = Supplier::query();

        if(isset($data['supplier_company']) && $data['supplier_company']!=''){
            $supplier->where('supplier_company','like','%'.$data['supplier_company'].'%');
        }

        if(isset($data['supplier_manager']) && $data['supplier_manager']!=''){
            $supplier->where('supplier_manager','like','%'.$data['supplier_manager'].'%');
            

        }
       if (isset($data['supplier_country']) && $data['supplier_country'] != '') {
            $supplier->where('supplier_country', 'like', '%' . $data['supplier_country'] . '%');
           
        }
         if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!='' && $data['startdate']==$data['enddate']){
            // $supplier->whereBetween('created_at',[$data['startdate'],$data['enddate']]);
            $supplier->whereDate('created_at','=',$data['startdate']);
        }
        else if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
            $supplier->whereDate('created_at','>=',$data['startdate'])->whereDate('created_at','<=',$data['enddate']) ;

        }
        // $supplier->orderBy('id','Desc')->get();
     
        $country = Country::get();
        if($request->ajax()){
            return DataTables::of($supplier->get())
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('supplier.index', compact('supplier','country'));
      
    }

    public function create(){
      
        $country = Country::get();
       return view('supplier.create',compact('country'));
    }
   
    public function store(Request $request)
    {
       
       
        $validator = Validator::make(  $request->all(),
        [
            'supplier_company'=>'required',
            // 'supplier_manager'=>'required',
            'supplier_email'=>'required|email|unique:supplier,supplier_email',
            // 'supplier_phone'=>'required',
            // 'supplier_whatsapp'=>'required',
            'supplier_country'=>'required',
            // 'other_detail'=>'required'

        ]
              
            );
    
            if (!$validator->fails()) {

                $user = Auth()->user()->id;

                $unique_no = Supplier::orderBy('id', 'DESC')->pluck('id')->first();
                if($unique_no == null or $unique_no == ""){
                    
                $unique_no = 1;
                $dt = Carbon::now();
                //  var_dump($dt->year);
                }
                else{
             
                    $unique_no = $unique_no + 1;
                    $dt = Carbon::now();
            
                }
                $rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
                $sp_no = 'SP'.$unique_no. '-' .$dt->year;
                
                $rfqno = $rfq_no;
                $spno = $sp_no;
                
                $supplier = new Supplier();
                $supplier->rfq_no = $rfqno;
                $supplier->sp_no = $spno;
                $supplier->supplier_company = $request->supplier_company;
                $supplier->supplier_manager = $request->supplier_manager;
                $supplier->supplier_email = $request->supplier_email;
                $supplier->supplier_phone = $request->supplier_phone;
                $supplier->supplier_whatsapp = $request->supplier_whatsapp;
                $supplier->supplier_country = $request->supplier_country;
                $supplier->other_detail = $request->other_detail;
                $supplier->user_id = auth()->user()->id;
    
                if ($supplier->save()) {
                    $response_data = ["success" => 1, "message" => "Supplier Created Successfully"];
                  
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
            }
    
            return response()->json($response_data);
    }


    public function edit(Supplier $supplier,$id){
       

        $user = Auth::user();
        $country = Country::get();
        $supplier = Supplier::where('id', $id)->first();     
        return view('supplier.edit', compact('supplier','country','id'));

}


    public function update(Request $request){

      

      $validator = Validator::make(  $request->all(),
        [
            'supplier_company'=>'required',
            // 'supplier_manager'=>'required',
            'supplier_email'=>'required',
            // 'supplier_phone'=>'required',
            // 'supplier_whatsapp'=>'required',
            'supplier_country'=>'required',
            // 'other_detail'=>'required'

        ]
              
        );
    
            if (!$validator->fails()) {


                  

                
                $supplier = new Supplier();
                $supplier = Supplier::where('id', $request->id)->first();
                $supplier->supplier_company = $request->supplier_company;
                $supplier->supplier_manager = $request->supplier_manager;
                $supplier->supplier_email = $request->supplier_email;
                $supplier->supplier_phone = $request->supplier_phone;
                $supplier->supplier_whatsapp = $request->supplier_whatsapp;
                $supplier->supplier_country = $request->supplier_country;
                $supplier->other_detail = $request->other_detail;
                $supplier->user_id = auth()->user()->id;
               
    
                if ($supplier->save()) {
                    $response_data = ["success" => 1, "message" => "Client Created Successfully"];
                  
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
            }
    
            return response()->json($response_data);

    }
    public function delete(Request $request,$id){
        $sub = Supplier::where('id',$id)->firstorfail()->delete();

        if($sub)

        
        {
            $response_data=["success"=>1,"message"=>"supplier delete success" ];
            return redirect()->route('Supplier.index');
        }
        else{
            $response_data= ["success"=>0,"message"=>"server side error"];
        }
        return response()->json($response_data);
    }
    
    public function cost(){
        $country = Country::get();
        return view('supplier.costRequest',compact('country'));
    }
    public function CostRequest(Request $req){
        $data = $req->all();
        $suppliercost=Supplier::latest();
        
        if (isset($data['supplier_company']) && $data['supplier_company'] != '') {
            $suppliercost->where('supplier_company', 'like', '%' . $data['supplier_company'] . '%');
           
        }
        if (isset($data['supplier_country']) && $data['supplier_country'] != '') {
            $suppliercost->where('supplier_country', 'like', '%' . $data['supplier_country'] . '%');
        }
        if ($req->ajax()) {
            
            return DataTables::of($suppliercost->get())->addIndexColumn()->make(true);
        }
        return view('supplier.costRequest',compact('suppliercost'));
    }
    public function suppliercountry(Request $req){
      
    if (!isset($req->supplierdata) || !is_array($req->supplierdata)) {
        return response()->json(['error' => 'Invalid data format.'], 400);
    }

    $supplierManagement = [];
    $country_name = [];

    foreach ($req->supplierdata as $s) {
        $suppliers = Supplier::select('id', 'supplier_country', 'supplier_email', 'supplier_company')
            ->where('supplier_country', $s)
            ->get()
            ->toArray();

        if (count($suppliers) > 0) {
            $supplierManagement = array_merge($supplierManagement, $suppliers); // Flatten the array
        }

        $countries = Supplier::select('id', 'supplier_country', 'supplier_email')
            ->where('supplier_country', $s)
            ->get()
            ->toArray();

        if (count($countries) > 0) {
            $country_name = array_merge($country_name, $countries); // Flatten the array
        }
    }

    return response()->json([
        'supplierManagement' => $supplierManagement,
        'supplier_details' => $country_name,
    ]);
    }
    
    public function supplierMail(Request $req)
    {
        if ($req->has('data')) {
            foreach ($req->data as $data) {
                if (isset($data['id']) && !empty($data['id'])) {
                    $supplier = Supplier::find($data['id']);
                    if (!$supplier) {
                        continue; // Skip if supplier not found
                    }
    
                    $supplierEmailContent = new SupplierEmailContent();
                    $supplierEmailContent->supplier_id = $data['id'];
                    $supplierEmailContent->user_id = auth()->user()->id;
                    $supplierEmailContent->content = $data['content'] ?? '';
    
                    $fileContent = '';
    
                    // Handle file upload
                    if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $data['file'];
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '_email_document.' . $extension;
                        $file->move(public_path('supplier'), $filename);
                        $fileContent = 'supplier/' . $filename;
                        $supplierEmailContent->file_content = $fileContent;
                    }
    
                    // Save email content to supplier table
                    $supplier->email_content = $data['content'] ?? '';
                    if (!empty($fileContent)) {
                        $supplier->file_content = $fileContent;
                    }
    
                    // Save and trigger email
                    if ($supplier->save() && $supplierEmailContent->save()) {
                        event(new SendSupplierMail([$supplier->supplier_email, $data['content'] ?? '', $fileContent]));
                    }
                }
            }
    
            return response()->json([
                "success" => 1,
                "message" => "Emails processed and saved successfully",
            ]);
        }
    
        return response()->json([
            "success" => 0,
            "message" => "Invalid or missing data",
        ]);
    }
    



    public function costRequestView(){
        $country=Country::get();
        return view('supplier.cost_request_view',compact('country'));
    }
    public function costRequestView1(Request $request){
        
        $data=$request->all();
        // dd($data);
        $supplier=Supplier::where('email_content','!=','');
        //   dd("hi");
        if (isset($data['supplier_company']) && $data['supplier_company'] != '') {
            
            $supplier->where('supplier_company', 'like', '%' . $data['supplier_company'] . '%');
          
           
        }
         if(isset($data['supplier_manager']) && $data['supplier_manager']!=''){
            $supplier->where('supplier_manager','like','%'.$data['supplier_manager'].'%');
            
        }
         
        if (isset($data['supplier_country']) && $data['supplier_country'] != '') {
            $supplier->where('supplier_country', 'like', '%' . $data['supplier_country'] . '%');
           
        }
        
       
        if(isset($data['startdate']) && $data['startdate']!='' && isset($data['enddate']) && $data['enddate'] != '' ){
           if( $data['startdate'] != $data['enddate'])
            $supplier->whereDate('updated_at','>=',$data['startdate'])->whereDate('updated_at',"<=",$data['enddate']);
            else    
            $supplier->whereDate('updated_at','=',$data['startdate']);
        }
       
            return Datatables::of($supplier->get())
           
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);

    }

    public function cost_request_view($id){
        $supplier=Supplier::find($id);
        return view('supplier.requestView',compact('supplier'));

    }
    // public function supplier_view(){
    //     $country = Country::get();
    //     return view('supplier.supplier_view',compact('country'));

    // }
    public function supplier_view1(Request $request){
        
        $data=$request->all();
        $supplier=Supplier::select('*');
        if (isset($data['supplier_company']) && $data['supplier_company'] != '') {
            $supplier->where('supplier_company', 'like', '%' . $data['supplier_company'] . '%');
           
        }
        
        
        if(isset($data['supplier_country']) && $data['supplier_country']!=''){
            
            $supplier->where('supplier_country','like','%'.$data['supplier_country'].'%');
            

        }
        if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
            $supplier->whereBetween('created_at',[$data['startdate'],$data['enddate']]);
        }
       
                
        
        
    
            return Datatables::of($supplier->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);

    }
    
     public function suppplier_overview(){
        $total_supplier= Supplier :: count();
        $total_supplier_1=[];
        $Total_Cost=[];
        // dd($total_supplier);
        $country= Country::get();
        $total_cost_request=supplieremailcontent::select('*')->count();
        return view('supplierdashboard',compact('total_supplier','total_cost_request','country','total_supplier_1','Total_Cost'));
   }
   public function suppplier_overview1(Request $request){
        // dd($request->all());
        $total_supplier= Supplier::select('*');
        // $total_cost_request=Supplier::select('*');
         $total_cost_request=supplieremailcontent::select('*');
            // if ($request->start_1 && $request->start_1!= ''&&$request->end_1 && $request->end_1!= '' && $request->start_1 == $request->end_1) {
            //     // dd("same");
            //     $total_supplier->whereDate('created_at','=',$request->start_1);
            //     $total_cost_request->whereDate('created_at','=',$request->start_1);
            // }else if ($request->start_1 && $request->start_1!= ''&&$request->end_1 && $request->end_1!= '') {
            //     $total_supplier->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1) ;
            //     $total_cost_request->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1);
            // }
            // if ($request->supplier_country && $request->supplier_country!= '') {
            //     $total_supplier->where('supplier_country', 'like', '%' .$request->supplier_country. '%');
            //     $total_cost_request->where('supplier_country', 'like', '%' .$request->supplier_country. '%');
            // }
            // if ($request->supplier_company && $request->supplier_company!= '') {
            //     $total_supplier->where('supplier_company', 'like', '%' .$request->supplier_company. '%');
            //     $total_cost_request->where('supplier_company', 'like', '%' .$request->supplier_company. '%');
            // }
             if ($request->start_1 && $request->start_1!= ''&&$request->end_1 && $request->end_1!= '' && $request->start_1 == $request->end_1) {
                 $total_supplier->whereDate('created_at','=',$request->start_1);
                //  $total_cost_request->whereDate('created_at','=',$request->start_1);
             }else if ($request->start_1 && $request->start_1!= ''&&$request->end_1 && $request->end_1!= '') {
                $total_supplier->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1) ;
                // $total_cost_request->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1);
             }
             if ($request->supplier_country && $request->supplier_country!= '') {
                 $total_supplier->where('supplier_country', 'like', '%' .$request->supplier_country. '%');
             }
             if ($request->supplier_company && $request->supplier_company!= '') {
                 $total_supplier->where('supplier_company', 'like', '%' .$request->supplier_company. '%');
             }
             $ids = $total_supplier->pluck('id')->toArray();
             
             $total_cost = $total_cost_request->whereIn('supplier_id',$ids)->get();
            //  dd($ids);
            //  dd(count($total_cost));
            //  dd($total_supplier->get());
                $total_supplier_count=count($total_supplier->get());
                $total_cost_request_count=count($total_cost);
        return response()->json(["total_supplier"=>$total_supplier_count,"total_cost_request"=>$total_cost_request_count]);   
        
    }

     public function supplier_view($id){
        
        $supplier=Supplier::find($id);
        return view('supplier.supplierView',compact('supplier'));

    }
    public function import(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the uploaded file
            // Process the file
            $import = new SupplierImport();
            Excel::import($import, $request->file('file'));
    
            DB::commit();
            return redirect()->back()->with('success', 'Imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollback();
            $failures = $e->failures();
            $validationErrors = [];
    
            foreach ($failures as $failure) {
                $row = $failure->row(); // Row number where error occurred
                $attribute = $failure->attribute(); // Column/Field name that caused the error
                $errors = $failure->errors(); // Array of error messages for that row
                $values = $failure->values(); // All values for that row
    
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
    
    public function performance(Request $req){
        // dd('hi');
        $supplier_detail = User::where('user_type','supplier')->get();
        $all1=User::where('user_type','supplier')->select('id')->get()->toArray();
        $all2=array();
        for($i=0;$i<count($all1);$i++){
            array_push($all2,$all1[$i]['id']);
        }
        $all=implode(",",$all2);
        // dd($all);
        // dd($supplier_detail);
        return view('supplier.performance',compact('supplier_detail','all'));
    }
        
    public function supplierperfomance(Request $req){
        // dd($req->id);
        if($req->id){
            $id=$req->id;
            if(is_numeric($id)){
             $supplier_cost=supplieremailcontent::where('user_id',$id)->where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
             $total_supplier=Supplier::where('user_id',$id)->where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
        // dd($supplier_cost);
             $response_data=["success"=>1,"message"=>"success",'supplier_cost'=>$supplier_cost,'total_supplier'=>$total_supplier];
            }
            else{
             $all=explode(",",$id);
             $supplier_cost=supplieremailcontent::whereIn('user_id',$all)->where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
             $total_supplier=Supplier::whereIn('user_id',$all)->where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
        // dd($supplier_cost);
             $response_data=["success"=>1,"message"=>"success",'supplier_cost'=>$supplier_cost,'total_supplier'=>$total_supplier];
            }
        }
        else{
           $response_data=["success"=>0,"message"=>"fail"]; 
        }
        return response()->json($response_data);
    }

   public function supplierPerformanceFilter(Request $req){
         $data=$req->all();
         
         $supplier = Supplier::latest();
         $date=explode("-",$data['daterange']);
         $startdate= date("Y-m-d", strtotime($date[0])); 
         $enddate=date("Y-m-d", strtotime($date[1]));
        //  dd($data['sales']);
        $all1=$data['sales'];
        $all=explode(",",$all1);
         if(is_numeric($all)){
         if(((isset($all) && $all!=''))&&((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))){
             $supplier->where('user_id',$all);
             $supplier->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
         }
         }
         else{
            if(((isset($all) && $all!=''))&&((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))){
             $supplier->whereIn('user_id',$all);
             $supplier->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
         }
         }
        if($req->ajax()){
            return DataTables::of($supplier->get())
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
      
   }
   
  public function supplierPerformanceCostFilter(Request $req){
      $data=$req->all();
      
      $cost =supplieremailcontent::latest();
    //   dd($cost);
    //   $date=explode("-",$data['daterange']);
    //   $startdate= date("Y-m-d", strtotime($date[0])); 
    //   $enddate=date("Y-m-d", strtotime($date[1]));
    //   if(((isset($data['sales']) && $data['sales']!=''))&&((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))){
    //       $cost->where('supplier_id','like','%'.$data['sales'].'%');
    //          $cost->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
    //   }
      
      if($req->ajax()){
            return DataTables::of($cost->get())
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
  }
  
  public function supplier_performance_view ($id){
      
        $supplier=Supplier::find($id);
        return view('supplier.supplier_performanece_view',compact('supplier'));
  }

  public function supplier_dashboard(Request $request)
  {
    
    $countryFilter = $request->get('country');
    $countries = Country::all(); // Fetch all countries from the `countries` table

    if ($request->ajax()) {
        // Filter suppliers by the selected country for AJAX requests
        $suppliersByCountry = Supplier::select('supplier_country', \DB::raw('count(*) as count'))
            ->when($countryFilter, function ($query) use ($countryFilter) {
                $query->where('supplier_country', $countryFilter);
            })
            ->groupBy('supplier_country')
            ->get();

        $suppliersData = Supplier::select('supplier_company', \DB::raw('count(*) as count'))
            ->when($countryFilter, function ($query) use ($countryFilter) {
                $query->where('supplier_country', $countryFilter);
            })
            ->groupBy('supplier_company')
            ->get();

        return response()->json([
            'suppliersByCountry' => $suppliersByCountry,
            'suppliersData' => $suppliersData,
        ]);
    }

    // Default rendering for the blade view
    $suppliersByCountry = Supplier::select('supplier_country', \DB::raw('count(*) as count'))
        ->groupBy('supplier_country')
        ->get();

    $suppliersData = Supplier::select('supplier_company', \DB::raw('count(*) as count'))
        ->groupBy('supplier_company')
        ->get();

    return view('supplier.supplier_dashboard', compact('countries', 'suppliersByCountry', 'suppliersData', 'countryFilter'));
  }

  public function generateSupplierSampleFile()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers
    $headers = [
        'A1' => 'supplier_company',
        'B1' => 'supplier_manager',
        'C1' => 'supplier_email',
        'D1' => 'supplier_phone',
        'E1' => 'supplier_whatsapp',
        'F1' => 'supplier_country',
        'G1' => 'other_detail'
    ];

    foreach ($headers as $cell => $value) {
        $sheet->setCellValue($cell, $value);
    }

    // Add sample data
    $sheet->setCellValue('A2', 'Tech Supplies Ltd');
    $sheet->setCellValue('B2', 'John Doe');
    $sheet->setCellValue('C2', 'johndoe@example.com');
    $sheet->setCellValue('D2', '1234567890');
    $sheet->setCellValue('E2', '9876543210');
    $sheet->setCellValue('F2', 'India');
    $sheet->setCellValue('G2', 'Details about the supplier');

    // Save the file
    $fileName = 'supplier-sample-file.xlsx';
    $filePath = public_path("assets/$fileName");

    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    return response()->download($filePath)->deleteFileAfterSend(false);
}
    
}
