<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidRfq;
use App\Models\WonProject;
use App\Models\Notification;
use App\Models\Country;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\OperationNew;
use App\Events\SendUserMail;
use App\Models\Fieldteam;
use App\Models\Procompleted;
use App\Models\User;
use App\Models\Clientrequest;
use App\Models\clientrequestbalance;
use App\Models\Vendorrequestadvance;
use App\Models\Vendorrequestbalance;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Session;
use DataTables;
use App\Models\operationImage;
use App\Models\RfqDetailsTable;
use CreateClientAdvanceRequest;
use DB;
use App\Models\RfqOnlineCommunity;
use App\Models\RfqSingleCountry;
use App\Models\RfqMultipleCountry;
use App\Models\RfqInterviewDepth;




class OperationNewController extends Controller
{
    public function createWon(Request $req)
    {  

        $user = auth()->user(); // Get the currently logged-in user

        // Base query for WonProject
        $wonproject = WonProject::query();
        // If the logged-in user is a Project Manager, filter by allocated RFQs
        // if ($user->user_role === 'project_manager') {
        //     // Get the RFQ values allocated to this Project Manager
        //     $allocatedRfqList = OperationNew::where('project_manager_name', $user->id)
        //         ->pluck('rfq')
        //         ->toArray();
        //     // dd($allocatedRfqList);
        //     // Ensure project managers only see their projects
        //     $wonproject->whereIn('rfq_no', $allocatedRfqList);
        // } 
        $wonproject=$wonproject->get();
        $vendor1=Vendor::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $bidrfq=RfqDetailsTable::get();
        $operation="";
        $operation=[];
        $operation_rfq = [];
        $rfq = OperationNew::select('rfq')->get()->pluck('rfq')->toArray();
        // dd($operation_rfq);
        $country = Country::get();
        $fieldteam=Fieldteam::get();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        $user3=User::where('user_role','operation_head')->get();
        $notification=Notification::where('status',0)->get();
        $notificationCount=Notification::where('status',0)->count();
        // $rfq = array();
        // for($i=0; $i< count($operation_rfq);$i++)
        // {
        //     array_push($rfq,$operation_rfq[$i]['rfq']);
        // }
        // dd($wonproject,$rfq);
        $unique_no = OperationNew::orderBy('id', 'DESC')->with('purchase_order_no','purchase_order_no')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 100;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 100;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $purchase_order_no = 'PO'.$unique_no. '-' .$dt->year;

        // if($unique_no == null or $unique_no == ""){
        //     #If Table is Empty
        //     $unique_no = 10;
        //     $dt = Carbon::now();
        //     // var_dump($dt->year);
        // }
        // else{
        //     #If Table has Already some Data
        //     $unique_no = $unique_no + 10;
        //     $dt = Carbon::now();
        //     // var_dump($dt->year);
        // }
        $project_no = 'PNO'.$unique_no. '-' .$dt->year;
        // dd($rfq,$wonproject->pluck('rfq_no'));
        //dd($wonproject->pluck('rfq_no')->toArray(),$rfq);
        return view('operationNew.createWon',compact('wonproject','bidrfq','client','vendor1','vendor','operation','purchase_order_no','project_no','country','notification','fieldteam','notificationCount','user','user1','user2','user3','operation_rfq','rfq'));
    }
    public function change(Request $req,WonProject $wonProject){
        $wonProject = WonProject::where ('rfq_no',$req->id)->first();
        $user3 = Auth::user();
        $all_country = Country::get();
        $all_vendor = Vendor::get();
        $all_client = Client::get();

        if($wonProject){
            $response_data = [
                "success" => 1,
                "message" => "successfully",
                "wonProject" => $wonProject,
                "user3" => $user3,
                "all_country" => $all_country,
                "all_vendor" => $all_vendor,
                "all_client" => $all_client,
            ];
        }
        else{
            $response_data=["success"=>0, "message"=>"server site error" ];
        }

        return Response()->json($response_data);

    }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
   
       public function index(Request $request)
       {
        $user = auth()->user(); // Get the currently logged-in user
        $data = $request->all();
    
        // Base query: Only fetch 'hold' status records
        $operation = OperationNew::whereIn('status', ['hold', 'pause']);
    
        // If the logged-in user is a Project Manager, filter by their ID
        if ($user->user_role === 'project_manager') {
            $operation->where('project_manager_name', $user->id); // Filter by project manager
        }
        
        // Apply additional filters (start date, end date, project number) if provided
        if (isset($data['startdate']) && $data['startdate'] !== '' && isset($data['enddate']) && $data['enddate'] !== '') {
            $operation->whereDate('created_at', '>=', $data['startdate'])
                      ->whereDate('updated_at', '<=', $data['enddate']);
        }
        if (isset($data['pno']) && $data['pno'] !== '') {
            $operation->where('project_no', 'LIKE', '%' . $data['pno'] . '%');
        }
        if (isset($data['status']) && $data['status'] !== '') {
            if ($data['status'] === 'live') {
                $operation->where('status', 'hold'); // 'hold' represents 'live'
            } else {
                $operation->where('status', $data['status']); // e.g., 'pause'
            }
        }
    
        // Handle Ajax requests for Datatables
        if ($request->ajax()) {
            return Datatables::of($operation->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Define your action buttons or links here
                  
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Pass data to the view (use pagination for large datasets)
   
        return view('operationNew.indexoperation', compact('operation'));
       }


       public function indexpm(Request $request)
       {
        $user = auth()->user(); // Get the currently logged-in user
        $data = $request->all();
    
        // Base query: Only fetch 'hold' status records
        $operation = OperationNew::whereIn('status', ['hold', 'pause']);       
    
        // If the logged-in user is a Project Manager, filter by their ID
        if ($user->user_role === 'project_manager') {
            $operation->where('project_manager_name', $user->id); // Filter by project manager
        }
        
        // Apply additional filters (start date, end date, project number) if provided
        if (isset($data['startdate']) && $data['startdate'] !== '' && isset($data['enddate']) && $data['enddate'] !== '') {
            $operation->whereDate('created_at', '>=', $data['startdate'])
                      ->whereDate('updated_at', '<=', $data['enddate']);
        }
        if (isset($data['pno']) && $data['pno'] !== '') {
            $operation->where('project_no', 'LIKE', '%' . $data['pno'] . '%');
        }

        if (isset($data['status']) && $data['status'] !== '') {
            if ($data['status'] === 'live') {
                $operation->where('status', 'hold'); // 'hold' represents 'live'
            } else {
                $operation->where('status', $data['status']); // e.g., 'pause'
            }
        }
    
        // Handle Ajax requests for Datatables
        if ($request->ajax()) {
            return Datatables::of($operation->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Define your action buttons or links here
                  
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Pass data to the view (use pagination for large datasets)
   
        return view('operationNew.indexoperationpm', compact('operation'));
       }
       

        public function field(Request $request){
        $id=Auth::user()->id;
       

        // $operation=OperationNew::where('status','hold','stop')->latest()->get();
        $operation=OperationNew::where('team_leader',$id)->orWhere('project_manager_name',$id)->orWhere('quality_analyst_name',$id)->get();
       
        if($request->ajax()){
            return Datatables::of($operation)
             ->addIndexColumn()
             ->addColumn('action', function($row){
   
            })
            ->rawColumns(['action'])
             ->make(true);
        }
        return view('operationNew.field_view',compact('operation'));
       }

       public function storeWon(Request $req)
       {
           $v = $req->all();
           
           $validator = Validator::make(
            $v,
            [
                ]
                
            );
            $user = Auth::user();
            
            // dd($user->id);
            
            
        if (!$validator->fails()) {
            $wonproject = new WonProject();
            $wonproject->rfq_no = $req->rfq_no;
            $wonproject->user_id = $user->id;
            $wonproject->project_name = $req->project_name;
            $wonproject->project_type = $req->project_type;
            $wonproject->project_execution = $req->project_execution;
            $wonproject->project_start_date = $req->project_start_date;
            $wonproject->project_end_date = $req->project_end_date;
            $wonproject->client_total = $req->client_total;
            $wonproject->vendor_total = $req->vendor_total;
            $wonproject->client_advance = $req->client_advance;
            $wonproject->client_balance = $req->client_balance;
            $wonproject->vendor_advance = $req->vendor_advance;
            $wonproject->vendor_balance = $req->vendor_balance;
            $wonproject->total_margin = $req->total_margin;
            $wonproject->date = $req->date;
            $wonproject->client_contract = $req->file('client_contract');
            
            if ($req->hasFile('client_contract'))
            {
                $file = $req->file('client_contract');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/client_contracts', $filename);
                $wonproject->client_contract = 'global_assets/client_contracts/' . $filename;
            }
            if ($req->has('vendor_contract'))
            {
                $file = $req->file('vendor_contract');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/vendor_contract', $filename);
                $wonproject->vendor_contract = 'global_assets/vendor_contract/' . $filename;
            }
            
            if ($wonproject->save()) {
                $response_data = ["success" => 1, "message" => "RfqBid Created Successfully"];
                // dd($wonproject->save());
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
                // dd($wonproject);
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }
    
    public function create()
    {
        $operation="";
        $operation=[];
        $country = Country::get();
        $fieldteam=Fieldteam::get();
        $unique_no = OperationNew::orderBy('id', 'DESC')->with('purchase_order_no','purchase_order_no')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 100;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 100;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $purchase_order_no = 'PO'.$unique_no. '-' .$dt->year;

        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 10;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 10;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $project_no = 'PNO'.$unique_no. '-' .$dt->year;
        
        // $project_no = $operation->project_no;
        // dd($project_no);
        return view('operationNew.create',compact('operation','purchase_order_no','project_no','country','fieldteam'));
    }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
    public function store(Request $req)
    {
        //dd($req->all());
        $response_data = [];
        $validator = Validator::make($req->all(),
        [
            'sample_achieved_0.*'=>'required',
            'sample_achieved_0.*' =>'required',
            "other_document" => 'required',
            
        ]);
    
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
            for($i=0; $i<$req->bidrfqCount; $i++)
            {
                
                $operation = new OperationNew();
                // $sample_target = 'sample_target_'.$i;
                // $sample_achieved = 'sample_achieved_'.$i;
                // $country_name = 'country_name_'.$i;
                
                $operation->respondent_incentives = $req->respondent_incentives;
                $operation->team_leader = $req->team_leader;
                $operation->rfq=$req->rfq;
                $operation->client_id=$req->client_id;
                $operation->quality_analyst_name = $req->quality_analyst_name;
                $operation->project_deliverable = $req->project_deliverable;
                $operation->project_manager_name = $req->project_manager_name;
                $operation->project_operation_head = $req->project_operation_head;
                $operation->respondent_type = json_encode($req->respondent_type);
                $operation->sample_target = json_encode($req->sample_target_0);
                $operation->sample_achieved =json_encode($req->sample_achieved_0);
                $operation->total =json_encode($req->total);
                $operation->project_comment = $req->project_comment;
                $operation->country_name = implode(',',$req->country_name_0);
                $operation->target_group = implode(',',$req->target_group);
                $operation->user_id = auth()->user()->id;
                if ($req->hasFile('questionnarie'))
                {
                    $file = $req->file('questionnarie');
                    // $time =  Carbon::now()->timestamp;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/questionnaries', $filename);
                    $operation->questionnarie = 'global_assets/questionnaries/' . $filename;
                }
                
                if ($req->has('survey_link'))
                {
                    $file = $req->file('survey_link');
                    // $time =  Carbon::now()->timestamp;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/survey_link', $filename);
                    $operation->survey_link = 'global_assets/survey_link/' . $filename;
                }
                $unique_no = OperationNew::orderBy('id', 'DESC')->with('purchase_order_no','purchase_order_no')->pluck('id')->first();
                if($unique_no == null or $unique_no == ""){
                    #If Table is Empty
                    $unique_no = 100;
                    $dt = Carbon::now();
                    // var_dump($dt->year);
                }
                else{
                    #If Table has Already some Data
                    $unique_no = $unique_no + 100;
                    $dt = Carbon::now();
                    // var_dump($dt->year);
                }
                $operation->purchase_order_no = 'PO'.$unique_no. '-' .$dt->year;
                
                // if($unique_no == null or $unique_no == ""){
                    //     #If Table is Empty
                    //     $unique_no = 10;
                    //     $dt = Carbon::now();
                    //     // var_dump($dt->year);
                    // }
                    // else{
                        //     #If Table has Already some Data
                //     $unique_no = $unique_no + 10;
                //     $dt = Carbon::now();
                //     // var_dump($dt->year);
                // }
                $operation->project_no = $req->project_no;
                if (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'operation') {
                    $operation->pm_updated_at = now()->toDateString(); // You can also use Carbon::now()
                }
                if ($operation->save()) {
                    if (count($req->other_document)> 0)
                    {
                    for($i=0 ; $i< count($req->other_document) ;$i++ )
                    {      $operationImage=new operationImage();
                        $operationImage->operation_id=$operation->id;
                        $file = $req->other_document[$i];
                        $extension = $file->getClientOriginalExtension();
                        $filename = time().$i. '.' .$extension;
                        $file->move('global_assets/other_document/', $filename);
                        // for($j=0; $j< count($req->other_document) ;$i++ ){
                         $operationImage->other_documents = 'global_assets/other_document/'. $filename;
                        // }
                        $operationImage->save();
                    }
                }
                     $notification=Notification::where('rfq_no',$operation->rfq)->update(['status' => 1]);
                    $response_data = ["success" => 1, "message" => "New Project Created Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            }
        } else {
            $response_data = ["success" => 0, "message" => "please Fill All fields", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }


    public function editoper(Request $req, WonProject $wonProject)
    {
        // Fetch the necessary data from your models
        $vendor1 = Vendor::get();
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $all_country = Country::get();
        $all_vendor = Vendor::get();
        $all_client = Client::get();
    
        // Get the currently authenticated user
        $user = Auth::user();
    
        $wonProject = BidRfq::get();
        foreach ($wonProject as $wonProject) {
            $id = $wonProject['id']; // Access the 'id' field for each record
        }
    
        $wonprojects = WonProject::where('rfq_no', $req->id)->first();
        $rfqNo = $wonprojects->rfq_no; // Extract the 'rfq_no' from the WonProject model
    
        $rfq_no = str_replace('{"rfq_no":"', '', $rfqNo);
        $rfq_no1 = str_replace('"}', '', $rfq_no);
        $rfq1 = explode('_', $rfq_no1);
        $bid = $rfq1[0];
    
        $bidrfq = RfqDetailsTable::where('rfq_no', $bid)->first();
        $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('rfq_no', $bid)->first();
        if ($newrfq) {
            $operation_data = view('operationNew.operation_data',compact('newrfq','client','vendor'))->render();
            // Compact the necessary data and pass it to the view
            $response_data = [
                "success" => 1,
                "message" => "successfully",
                "bidrfq" => $bidrfq,
                "user" => $user,
                "all_country" => $all_country,
                "all_vendor" => $all_vendor,
                "all_client" => $all_client,
                "operation_data" => $operation_data
            ];
        } else {
            $response_data = ["success" => 0, "message" => "server site error"];
            return response()->json($response_data);
        }
    
        return response()->json($response_data);
    }
    

    // public function editoper($id,Bidrfq $bidrfq)
    // {
    //     $wonproject= Bidrfq::select('rfq_no')->get()->toArray();
    //     $country = Country::get();
    //     $vendor = Vendor::get();
    //     $client = Client::get();
    //     $bidrfq = BidRfq::where('id', $id)->first();
    //     $rfq = array();
    //     for($i=0; $i< count($wonproject);$i++)
    //     {
    //         array_push($rfq,$wonproject[$i]['rfq_no']);
    //     }
    //     return view('operationNew.createWon',compact('bidrfq','client','vendor','country','id','wonproject','rfq'));
    // }
    // public function edit($id)
    // {

    //     // $bidrfq = BidRfq ::get();
    //     $vendor1=Vendor::get();
    //     $country = Country::get();
    //     $vendor = Vendor::get();
    //     $client = Client::get();
    //     $wonproject = WonProject::where('id', $id)->first();
    //     $rfq= WonProject::where('id', $id)->select('rfq_no')->first();
    //     $rfq_no=str_replace('{"rfq_no":"','', $rfq);
    //     $rfq_no1=str_replace('"}','',$rfq_no);
    //     $rfq1=explode('_',$rfq_no1);
    //     $bid=$rfq1[0];
    //     $bidrfq = BidRfq::where('rfq_no', $bid)->first();
    //     // dd($bidrfq);
        
    //     return view('wonproject.edit', compact('wonproject','bidrfq','vendor1','client','vendor','country'));
    //    }

    public function edit($id,OperationNew $operation){
        $newrfq = RfqDetailsTable ::get();
        $country_fetch = Country::get();
        $vendor = Vendor::get();
        $fieldteam=Fieldteam::get();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        $user3 = Auth::user();
        $user4=User::where('user_role','operation_head')->get();
        $operation=OperationNew::with('operationNewImage')->where('id',$id)->first();
        $client = Client::get();
        $wonproject = WonProject::where('rfq_no', $operation->rfq)->first();
        $rfq= WonProject::where('id', $id)->select('rfq_no')->first();
        $rfq_no=str_replace('{"rfq_no":"','', $operation->rfq);
        $rfq_no1=str_replace('"}','',$rfq_no);
        $rfq1=explode('_',$rfq_no1);
        $bid=$rfq1[0];
        $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('rfq_no', $bid)->first();
        // $user = Auth::user();
        return view('operationNew.edit',compact('wonproject','newrfq','client','vendor','country_fetch','id','operation','fieldteam','user','user1','user2','user3','user4'));
    }

    public function editpm($id,OperationNew $operation){
        $newrfq = RfqDetailsTable ::get();
        $country_fetch = Country::get();
        $vendor = Vendor::get();
        $fieldteam=Fieldteam::get();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        $user3 = Auth::user();
        $user4=User::where('user_role','operation_head')->get();
        $operation=OperationNew::with('operationNewImage')->where('id',$id)->first();
        $client = Client::get();
        $wonproject = WonProject::where('rfq_no', $operation->rfq)->first();
        $rfq= WonProject::where('id', $id)->select('rfq_no')->first();
        $rfq_no=str_replace('{"rfq_no":"','', $operation->rfq);
        $rfq_no1=str_replace('"}','',$rfq_no);
        $rfq1=explode('_',$rfq_no1);
        $bid=$rfq1[0];
        $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('rfq_no', $bid)->first();
        // $user = Auth::user();
        return view('operationNew.editpm',compact('wonproject','newrfq','client','vendor','country_fetch','id','operation','fieldteam','user','user1','user2','user3','user4'));
    }

     public function closeedit($id,OperationNew $operation){
        $newrfq = RfqDetailsTable ::get();
        $country_fetch = Country::get();
        $vendor = Vendor::get();
        $fieldteam=Fieldteam::get();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        $user3 = Auth::user();
        $user4=User::where('user_role','operation_head')->get();
        $operation=OperationNew::with('operationNewImage')->where('id',$id)->first();
        $client = Client::get();
        $wonproject = WonProject::where('rfq_no', $operation->rfq)->first();
        $rfq= WonProject::where('id', $id)->select('rfq_no')->first();
        $rfq_no=str_replace('{"rfq_no":"','', $operation->rfq);
        $rfq_no1=str_replace('"}','',$rfq_no);
        $rfq1=explode('_',$rfq_no1);
        $bid=$rfq1[0];
        $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('rfq_no', $bid)->first();
        return view('operationNew.closeview',compact('wonproject','newrfq','client','vendor','country_fetch','id','operation','fieldteam','user','user1','user2','user3','user4'));
    }
    
    public function removeImage(Request $req){
        // dd($req->all());
        $removeoperation=operationImage::where('id',$req->value)->delete();
        // dd($removeoperation);
        return response()->json($removeoperation);
    } 


    public function update(Request $req){
        //dd($req);
        $response_data = [];
        $validator = Validator::make($req->all(), [
            'sample_achieved_0.*'=>'required',
            'sample_achieved_0.*' =>'required',


          ]);
          
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
            for($i=0; $i<$req->bidrfqCount; $i++)
            {
                $operation = new OperationNew();
                $operation = OperationNew::where('id',$req->id)->first();
                // dd($req->id);
               $operation->project_no = $req->project_no;
                $operation->purchase_order_no = $req->purchase_order_no;
                $sample_target = 'sample_target_'.$i;
                $sample_achieved = 'sample_achieved_'.$i;
                $country_name = 'country_name_'.$i;
                $operation->respondent_incentives = $req->respondent_incentives;
                $operation->team_leader = $req->team_leader;
                $operation->quality_analyst_name = $req->quality_analyst_name;
                $operation->project_deliverable = $req->project_deliverable;
                $operation->project_manager_name = $req->project_manager_name;
                $operation->respondent_type = json_encode($req->respondent_type);
                $operation->sample_target = json_encode($req->sample_target_0);
                $operation->sample_achieved =json_encode($req->sample_achieved_0);
                $operation->total =json_encode($req->total);
                $operation->country_name = implode(',',$req->country_name_0);
                $operation->target_group = implode(',',$req->target_group);
                $operation->project_comment = $req->project_comment;
                $operation->user_id = auth()->user()->id;
                if ($req->hasFile('questionnarie'))
                {
                    $file = $req->file('questionnarie');
                    // $time =  Carbon::now()->timestamp;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/questionnaries', $filename);
                    $operation->questionnarie = 'global_assets/questionnaries/' . $filename;
                }
                // if ($req->has('other_document'))
                // {
                //     $file = $req->file('other_document');
                //     // $time =  Carbon::now()->timestamp;
                //     $extension = $file->getClientOriginalExtension();
                //     $filename = time() . '.' .$extension;
                //     $file->move('global_assets/other_document', $filename);
                //     $operation->other_document = 'global_assets/other_document/' . $filename;
                // }
                if ($req->has('survey_link'))
                {
                    $file = $req->file('survey_link');
                    // $time =  Carbon::now()->timestamp;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/survey_link', $filename);
                    $operation->survey_link = 'global_assets/survey_link/' . $filename;
                }

                if (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'operation') {
                    $operation->pm_updated_at = now()->toDateString(); // You can also use Carbon::now()
                }
        
                if ($operation->save()) {
                    $response_data = ["success" => 1, "message" => "New Project Created Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            }
        } else {
            $response_data = ["success" => 0, "message" => "please Fill All fields", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);   
    }

    public function add_field_team(){
        return view('operationNew.add_field_team');
        
    }
    public function addFieldTeam(Request $request)
    {
        $field_team = new Fieldteam();
        $field_team->team_leader = $request->input('team_leader');
        $field_team->project_manager_name = $request->input('project_manager_name');
        $field_team->quality_analyst_name = $request->input('quality_analyst_name');
        $field_team->user_id = auth()->user()->id;
        $field_team->save();
    }

  public function addproject(Request $req){

    
        $validator=Validator::make($req->all(),[
        //    'clientadvance'=>'required',
           'clientbalance'=>'required',
        //    'vendoradvance'=>'required',
        //    'vendorbalance'=>'required',
        //    'respondentfile'=>'required',
           'clientinvoicefile'=>'required',
        //    'vendorinvoicefile'=>'required',
           'client_confirmation'=>'required',
        //    'vendor_confirmation'=>'required',
        ]);
        if(!$validator->fails()){
        $procompleted = Procompleted::where('operation_id', $req->id)->first() ?? new Procompleted();
        $procompleted->operation_id = $req->id;
        $procompleted->clientadvance = $req->clientadvance;
        $procompleted->clientbalance = $req->clientbalance;
        $procompleted->vendoradvance = $req->vendoradvance;
        $procompleted->vendorbalance = $req->vendorbalance;
        $procompleted->user_id = auth()->user()->id;
        $procompleted->operation_id = $req->id; 
        if($req->hasfile('respondentfile'))
        {
          $file=$req->file('respondentfile');
          $extension = $file->getClientOriginalExtension();
          $filename =  time() . '.' .$extension;
          $file->move('global_assets/respondentfile', $filename);
          $procompleted->respondentfile = 'global_assets/respondentfile/' . $filename;
        }
        if($req->hasfile('clientinvoicefile')){
            $file=$req->file('clientinvoicefile');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('global_assets/clientinvoicefile', $filename);
            $procompleted->clientinvoicefile = 'global_assets/clientinvoicefile/' . $filename;
        }
        if($req->hasfile('vendorinvoicefile')){
            $file=$req->file('vendorinvoicefile');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('global_assets/vendorinvoicefile', $filename);
            $procompleted->vendorinvoicefile= 'global_assets/vendorinvoicefile/' . $filename; 
        }
        if($req->hasfile('client_confirmation')){
            $file=$req->file('client_confirmation');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('global_assets/client_confirmation', $filename);
            $procompleted->client_confirmation= 'global_assets/client_confirmation/' . $filename; 
            
        }
        if($req->hasfile('vendor_confirmation')){
            $file=$req->file('vendor_confirmation');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('global_assets/vendor_confirmation', $filename);
            $procompleted->vendor_confirmation= 'global_assets/vendor_confirmation/' . $filename;      
        }
        if($procompleted->save()){
            $response_data=["success"=>1,"messsge"=>"sucessfully","vendorbalance"=>$req->vendorbalance,"vendoradvance"=>$req->vendoradvance,"clientbalance"=>$req->clientbalance,"clientadvance"=>$req->clientadvance];
        }
        else{
            $response_data=["success"=>0,"messsge"=>"failed"];
        }
        }
        else{
            $response_data=["success"=>0,"messsge"=>"please fill all fields","error" => $validator->errors()];
        }
        return response()->json($response_data);
        
        


    }


    public function add(Request $req){
        $validator =Validator::make($req->all(),
            [
               'comments'=>'required',
            ]);

            if(!$validator->fails()){
                $operation = OperationNew::where('id',$req->id)->update(['comments' => $req->comments]);
                if($operation){
                    $response_data=["success"=>1,"message"=>"comments success" ];
                }
                else{
                    $response_data=["success"=>0,"message"=>"comments fail"];

                }
            }
            else{
                $response_data=["sucsess"=>0,"message"=>"please fill fileds", "error"=>$validator->errors()];
            }

            return response()->json($response_data);

    }
    
    
     public function tladd(Request $req){
        $validator =Validator::make($req->all(),
            [
               'comments'=>'required',
            ]);

            if(!$validator->fails()){
                $operation = OperationNew::where('id',$req->id)->update(['tl_msg' => $req->comments]);
                if($operation){
                    $response_data=["success"=>1,"message"=>"comments success" ];
                }
                else{
                    $response_data=["success"=>0,"message"=>"comments fail"];

                }
            }
            else{
                $response_data=["sucsess"=>0,"message"=>"please fill fileds", "error"=>$validator->errors()];
            }

            return response()->json($response_data);

    }
    public function pmadd(Request $req){
        $validator =Validator::make($req->all(),
            [
               'comments'=>'required',
            ]);

            if(!$validator->fails()){
                $operation = OperationNew::where('id',$req->id)->update(['pm_msg' => $req->comments]);
                if($operation){
                    $response_data=["success"=>1,"message"=>"comments success" ];
                }
                else{
                    $response_data=["success"=>0,"message"=>"comments fail"];

                }
            }
            else{
                $response_data=["sucsess"=>0,"message"=>"please fill fileds", "error"=>$validator->errors()];
            }

            return response()->json($response_data);

    }
    public function qladd(Request $req){
        $validator =Validator::make($req->all(),
            [
               'comments'=>'required',
            ]);

            if(!$validator->fails()){
                $operation = OperationNew::where('id',$req->id)->update(['ql_msg' => $req->comments]);
                if($operation){
                    $response_data=["success"=>1,"message"=>"comments success" ];
                }
                else{
                    $response_data=["success"=>0,"message"=>"comments fail"];

                }
            }
            else{
                $response_data=["sucsess"=>0,"message"=>"please fill fileds", "error"=>$validator->errors()];
            }

            return response()->json($response_data);

    }

     
    public function ohadd(Request $req){
        $validator =Validator::make($req->all(),
            [
               'comments'=>'required',
            ]);

            if(!$validator->fails()){
                $operation = OperationNew::where('id',$req->id)->update(['oh_msg' => $req->comments]);
                if($operation){
                    $response_data=["success"=>1,"message"=>"comments success" ];
                }
                else{
                    $response_data=["success"=>0,"message"=>"comments fail"];

                }
            }
            else{
                $response_data=["sucsess"=>0,"message"=>"please fill fileds", "error"=>$validator->errors()];
            }

            return response()->json($response_data);

    }
    public function middle(Request $req){
      
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if(!$validator->fails()){
         $operation = OperationNew::where('id',$req->id)->update(['status'=>'stop']);

         if($operation){
             $response_data=["success"=>1,"message"=>"status success"];
         }
         else{
            $response_data=["success"=>0,"message"=>"status fail"];
         }

        }
        else{
            $response_data=["success"=>0,"message"=>"status fail"];
        }
        return response()->json($response_data);
    }

    public function hold(Request $req){
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if(!$validator->fails()){
         $operation = OperationNew::where('id',$req->id)->update(['status'=>'hold']);

         if($operation){
             $response_data=["success"=>1,"message"=>"hold success"];
         }
         else{
            $response_data=["success"=>0,"message"=>"hold fail"];
         }

        }
        else{
            $response_data=["success"=>0,"message"=>"please fill all fields"];
        }
        return response()->json($response_data);
    }
    public function getclose(Request $req){
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if(!$validator->fails()){
         $operation = OperationNew::where('id',$req->id)->update(['status'=>'completed']);

         if($operation){
             $response_data=["success"=>1,"message"=>"completed success"];
         }
         else{
            $response_data=["success"=>0,"message"=>"completed fail"];
         }

        }
        else{
            $response_data=["success"=>0,"message"=>"please fill all fields"];
        }
        return response()->json($response_data);
    }

    public function indexclose(Request $request){
        $user = Auth()->user();
        $data=$request->all();
         $operation=OperationNew::where('status','completed')->latest();

         if ($user->user_role === 'project_manager') {
            $operation->where('project_manager_name', $user->id); // Filter by project manager
        }
    
          if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
              $operation->whereDate('created_at','>=',$data['startdate'])->whereDate('updated_at','<=',$data['enddate']);  
          }
          if(isset($data['pno']) && $data['pno']!=''){
              $operation->where('project_no','Like','%'.$data['pno'].'%');  
          }
          
        
        if($request->ajax()){
            return Datatables::of($operation->get())
             ->addIndexColumn()
             ->addColumn('action', function ($row) use ($user) {
                if ($user->user_type == 'admin') {
                    return "<a href='/adminapp/operationNew/close/edit/{$row->id}'><i class='fas fa-eye'></i></a>";
                }
                return '';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('operationNew.closedproject',compact('operation'))->with('user_type', $user->user_type);
    }
    public function fieldclose(Request $request){
        $id=Auth::user()->id;
        $pid=OperationNew::select('project_manager_name')->get()->toArray();
        $pid1 = array();
        for($i=0; $i< count($pid);$i++)
        {
            array_push($pid1,$pid[$i]['project_manager_name']);
        }
        $tid=OperationNew::select('team_leader')->get()->toArray();
         $tid1 = array();
        for($i=0; $i< count($tid);$i++)
        {
            array_push($tid1,$tid[$i]['team_leader']);
        }
        $qid=OperationNew::select('quality_analyst_name')->get()->toArray();
         $qid1 = array();
        for($i=0; $i< count($qid);$i++)
        {
            array_push($qid1,$qid[$i]['quality_analyst_name']);
        }
        // dd((in_array(($id), $pid1)));
        $data=$request->all();
        if((in_array(($id), $qid1))){
            $operation=OperationNew::where('status','completed')->where('quality_analyst_name',$id)->latest();
            // dd($operation);
        }
        elseif((in_array(($id), $pid1))){
            $operation=OperationNew::where('status','completed')->where('project_manager_name',$id)->latest();
            // dd($operation);
        }
        elseif((in_array(($id), $tid1))){
            $operation=OperationNew::where('status','completed')->where('team_leader',$id)->latest();
        }
        // $operation=OperationNew::where('status','completed')->orwhere('quality_analyst_name',$id)->orWhere('project_manager_name',$id)->orWhere('team_leader',$id)->get();
        // dd($operation);
          if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
              $operation->whereDate('created_at','>=',$data['startdate'])->whereDate('updated_at','<=',$data['enddate']);  
          }
          if(isset($data['pno']) && $data['pno']!=''){
              $operation->where('project_no','Like','%'.$data['pno'].'%');  
          }

        if($request->ajax()){
            return Datatables::of($operation->get())
             ->addIndexColumn()
             ->addColumn('action', function($row){
   
            })
            ->rawColumns(['action'])
             ->make(true);
        }
        return view('operationNew.field_closed',compact('operation'));
    }

    public function status(){

        $closed=OperationNew::where('status','completed')->count();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        return view('operationNew.projectstatus',compact('closed','user','user1','user2'));
    }
    public function getclientadvance(Request $req){
        $wonproject=WonProject::where('rfq_no',$req->id)->first();
        if($wonproject){
            $response_data=["success"=>1,"message"=>"successfully","wonproject"=>$wonproject];
        }
        else{
            $response_data=["success"=>0,"message"=>"fail","wonproject"=>$wonproject];

        }

        return response()->json($response_data);


    }
    public function getclientbalance(Request $req){
        $wonproject=WonProject::where('rfq_no',$req->id)->first();
        if($wonproject){
            $response_data=["success"=>1,"message"=>"successfully","wonproject"=>$wonproject];
        }
        else{
            $response_data=["success"=>0,"message"=>"fail","wonproject"=>$wonproject];

        }
        return response()->json($response_data);

    }
    public function getvendoradvance(Request $req){
        $wonproject=WonProject::where('rfq_no',$req->id)->first();
        if($wonproject){
            $response_data=["success"=>1,"message"=>"successfully","wonproject"=>$wonproject];
        }
        else{
            $response_data=["success"=>0,"message"=>"fail","wonproject"=>$wonproject];

        }
        return response()->json($response_data);

    }



    public function operation(Request  $request)
    {
       $operation=OperationNew::get();
       $closed=OperationNew::where('status','completed')->count();
       $stop=OperationNew::where('status','stop')->count();
       $hold=OperationNew::where('status','hold')->count();
       $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        return view('operationNew.projectstatus', compact('closed','stop','hold','operation','user','user1','user2'));
    }
    public function figures(Request $request)
    { 
        if($request->team_leader !=''){
            $Completed_total = OperationNew::where('team_leader','=',$request->team_leader)->where('status','completed')->count();
            $hold_total = OperationNew::where('team_leader','=',$request->team_leader)->where('status','hold')->count();
            $stop_total = OperationNew::where('team_leader','=',$request->team_leader)->where('status','stop')->count();
            }
         if($request->project_manager_name !=''){
            $Completed_total = OperationNew::where('project_manager_name','=',$request->project_manager_name)->where('status','completed')->count();
            $hold_total = OperationNew::where('project_manager_name','=',$request->project_manager_name)->where('status','hold')->count();
            $stop_total = OperationNew::where('project_manager_name','=',$request->project_manager_name)->where('status','stop')->count();
           }
        if($request->quality_analyst_name !=''){
            $Completed_total = OperationNew::where('quality_analyst_name','=',$request->quality_analyst_name)->where('status','completed')->count();
            $hold_total = OperationNew::where('quality_analyst_name','=',$request->quality_analyst_name)->where('status','hold')->count();
            $stop_total = OperationNew::where('quality_analyst_name','=',$request->quality_analyst_name)->where('status','stop')->count();
           }
        return response()->json([
            'Completed' => $Completed_total,
            'hold' => $hold_total,
            'stop' =>$stop_total,
        ]);
    
    }
    public function chart(Request $req)
{
    // If no filters are applied, fetch all data
    if (empty($req->start_1) && empty($req->end_1)) {
        // Total open projects: Exclude 'completed' status
        $new = OperationNew::where('status', '!=', 'completed')->count();
    
        // Total closed projects: Only 'completed' status
        $closed = OperationNew::where('status', 'completed')->count();
    } else {
        // If a specific date or range is provided
        if ($req->start_1 == $req->end_1) {
            // Open projects for the specific date
            $new = OperationNew::whereDate('created_at', '=', $req->start_1)
                ->where('status', '!=', 'completed')
                ->count();
    
            // Closed projects for the specific date
            $closed = OperationNew::whereDate('created_at', '=', $req->start_1)
                ->where('status', 'completed')
                ->count();
        } else {
            // Open projects for the date range
            $new = OperationNew::whereDate('created_at', '>=', $req->start_1)
                ->whereDate('created_at', '<=', $req->end_1)
                ->where('status', '!=', 'completed')
                ->count();
    
            // Closed projects for the date range
            $closed = OperationNew::whereDate('created_at', '>=', $req->start_1)
                ->whereDate('created_at', '<=', $req->end_1)
                ->where('status', 'completed')
                ->count();
        }
    }
    
    // Return the data as JSON for the frontend
    return response()->json([
        "new" => $new,
        "closed" => $closed
    ]);
    
}

    
    
public function fieldchart(Request $req)
{
    $new = 0;
    $existing = 0;
    $closed = 0;
    $stop = 0;
    $pause = 0;

    // Get the logged-in user's role and ID
    $user = auth()->user();
    $isProjectManager = $user->user_role === 'project_manager'; // Check if the user is a project manager
    $userId = $user->id;

    // Query `BidRfq` table for new projects based on `type = 'next'`
    $newQuery = Notification::where('status',0);

    if (!empty($req->start_1) && !empty($req->end_1)) {
        $newQuery->whereBetween('created_at', [$req->start_1, $req->end_1]);
    }

    // if ($isProjectManager) {
    //     // If the user is a project manager, filter BidRfq projects based on allocated projects
    //     $newQuery->whereHas('operationNew', function ($query) use ($userId) {
    //         $query->where('project_manager_name', $userId);
    //     });
    // }

    $new = $newQuery->count(); // Count the "next" type projects

    // Query `OperationNew` for all statuses
    $operationQuery = OperationNew::query();



    if (!empty($req->start_1) && !empty($req->end_1)) {
        $operationQuery->whereBetween('created_at', [$req->start_1, $req->end_1]);
    }

    if ($isProjectManager) {
        // If the user is a project manager, filter OperationNew projects based on allocated projects
        $operationQuery->where('project_manager_name', $userId);
    }

    $operations = $operationQuery->get();

    foreach ($operations as $operation) {
        if ($operation->status == 'hold') {
            $existing++; // Ongoing projects
        } elseif ($operation->status == 'completed') {
            $closed++; // Completed projects
        } elseif ($operation->status == 'stop') {
            $stop++; // Stop in middle projects
        } elseif ($operation->status == 'pause') {
            $pause++; // Stop in middle projects
        }
    }

    // Return counts as JSON
    return response()->json([
        "new" => $new,         // New projects from BidRfq
        "existing" => $existing, // Existing (ongoing) projects from OperationNew
        "closed" => $closed,   // Completed projects from OperationNew
        "stop" => $stop,  // Stop in middle projects from OperationNew
        "pause" => $pause,  
    ]);
}




    // accounts

    private function restoreAddress($str)
    {
        return str_replace(
            [
                '[slash]', '[comma]', '[dot]', '[colon]', '[semicolon]',
                '[quote]', '[doublequote]', '[and]', '[hash]', '[percent]',
                '[question]', '[equal]', '[plus]', '[at]'
            ],
            [
                '/', ',', '.', ':', ';',
                "'", '"', '&', '#', '%',
                '?', '=', '+', '@'
            ],
            $str
        );
    }


    public function clientrequest(Request $req){
        // dd($req->all());
        $oldrfq=Clientrequest::select('rfq')->get()->toArray();
        $oldinvoice_type=Clientrequest::select('invoice_type')->get()->toArray();
        $result = array();
           foreach($oldrfq as $key=>$val){
            //   dd($val['rfq']);// Loop though one array
             $val2 = $oldinvoice_type[$key];          // Get the values from the other array
             
             $result[$key]=$val['rfq']."-".$val2['invoice_type'];
             
           }
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        $check=$req->id.'-'.$req->invoice_type;
     
       if(!in_array($check,$result)) { 
       if(!$validator->fails()){
           $clientrequest= new Clientrequest();
           $clientrequest->rfq=$req->id;
           $clientrequest->client_id=$req->client_id;
           $amount=explode(" ",$req->amount); 
           $currency = $amount[0];
           $amount1 = $amount[1];
           $clientrequest->currency=$currency;
           $clientrequest->amount=$amount1;
           $clientrequest->client_contract=$req->client_contract;
           $clientrequest->invoice_type=$req->invoice_type;
           $clientrequest->operation_id=$req->operation_id;
         if (in_array($req->invoice_type, ['advance', 'balance'])) {
        $clientrequest->client_manager = $req->client_manager;
        $clientrequest->client_address = $this->restoreAddress(urldecode($req->client_address));// decoding here
        $clientrequest->client_po_number = $req->client_po_number;
        $clientrequest->client_pn_number = $req->client_pn_number;

        if ($req->invoice_type === 'advance') {
            $clientrequest->advance_comment = $req->advance_comment ?? null;
        }

        if ($req->invoice_type === 'balance') {
            $clientrequest->balance_comment = $req->balance_comment ?? null;
        }
    }

   
           if($clientrequest->save()){
               $response_data=["success"=>1,"message"=>"sucesssfully"];
           }
           else{
            $response_data=["success"=>0,"message"=>"fail"];
           }
       }
      
       else{
        $response_data=["success"=>0,"message"=>"server site error"];
       }
       }
       else{
           $response_data=["success"=>2,"message"=>"already submit"];
       }
    return response()->json($response_data);
    }

    public function clientrequest1(Request $req){
    
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );

       if(!$validator->fails()){
           $clientrequest= new clientrequestbalance();
           $clientrequest->rfq=$req->id;
           $clientrequest->client_id=$req->client_id;
           $clientrequest->client_balance=$req->client_balance;
           $clientrequest->client_contract=$req->client_contract;
           $clientrequest->operation_id=$req->operation_id;

           if($clientrequest->save()){
               $response_data=["success"=>1,"message"=>"sucesssfully"];
           }
           else{
            $response_data=["success"=>0,"message"=>"fail"];
           }
       }
       else{
        $response_data=["success"=>0,"message"=>"server site error"];
       }
    return response()->json($response_data);
    }

    
    public function clientfinal(Request $req){
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        // dd($req->all());
        if(!$validator->fails()){
         $operation = OperationNew::where('rfq',$req->id)->update(['client_final_invoice'=>$req->client_final_val]);
         

         if($operation){
             $response_data=["success"=>1,"message"=>"completed success"];
         }
         else{
            $response_data=["success"=>0,"message"=>"completed fail"];
         }

        }
        
        else{
            $response_data=["success"=>0,"message"=>"please fill all fields"];
        }
        // dd('$operation');
        return response()->json($response_data);
    }


    public function vendorrequestadvance(Request $req){
        $oldrfq=Vendorrequestadvance::select('rfq')->get()->toArray();
        $oldinvoice_type=Vendorrequestadvance::select('invoice_type')->get()->toArray();
        $oldvendor=Vendorrequestadvance::select('vendor_id')->get()->toArray();
        $result = array();
           foreach($oldrfq as $key=>$val){
             $val2 = $oldvendor[$key];      
             $val3 = $oldinvoice_type[$key];
             $result[$key]=$val['rfq']."-".$val2['vendor_id']."-".$val3['invoice_type'];
             
           }
           
        $check=$req->id."-".$req->vendor_id."-".$req->invoice_type;
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
       if(!in_array($check,$result)){
       if(!$validator->fails()){
           $vendorrequest= new Vendorrequestadvance();
           $vendorrequest->rfq=$req->id;
           $vendorrequest->operation_id=$req->operation_id;
           $vendorrequest->vendor_id=$req->vendor_id;
           $vendor=explode(' ',$req->amount);
           $currency=$vendor[0];
           $amount=$vendor[1];
           $vendorrequest->amount=$amount;
           $vendorrequest->currency=$currency;
           $vendorrequest->invoice_type=$req->invoice_type;
           $vendorrequest->vendor_contract=$req->vendor_contract;

           if($vendorrequest->save()){
               $response_data=["success"=>1,"message"=>"sucesssfully"];
           }
           else{
            $response_data=["success"=>0,"message"=>"fail"];
           }
       }
       else{
        $response_data=["success"=>0,"message"=>"server site error"];
       }
       }
       else{
           $response_data=["success"=>2,"message"=>"already submit"];
       }
    return response()->json($response_data);
    }



    public function vendorrequestbalance(Request $req){
       
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );

       if(!$validator->fails()){
           $vendorrequest1= new Vendorrequestbalance();
           $vendorrequest1->rfq=$req->id;
           $vendorrequest1->operation_id=$req->operation_id;
           $vendorrequest1->vendor_id=$req->vendor_id;
           $vendorrequest1->vendor_balance=$req->vendor_balance;
           $vendorrequest1->vendor_contract=$req->vendor_contract;

           if($vendorrequest1->save()){
               $response_data=["success"=>1,"message"=>"sucesssfully"];
           }
           else{
            $response_data=["success"=>0,"message"=>"fail"];
           }
       }
       else{
        $response_data=["success"=>0,"message"=>"server site error"];
       }
    return response()->json($response_data);
    }
    
    public function vendorfinal(Request $req){
        $v = $req->all();
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        // dd($req->all());
        if(!$validator->fails()){
         $operation = OperationNew::where('rfq',$req->id)->update(['vendor_final_invoice'=>$req->vendor_final_val]);
         

         if($operation){
             $response_data=["success"=>1,"message"=>"completed success"];
         }
         else{
            $response_data=["success"=>0,"message"=>"completed fail"];
         }

        }
        
        else{
            $response_data=["success"=>0,"message"=>"please fill all fields"];
        }
        // dd('$operation');
        return response()->json($response_data);
    }
    
    public function projectview($id){
        // $user = Auth()->user();
        // $operation=OperationNew::latest()->get();

        // if($request->ajax()){
        //     return Datatables::of($operation)
        //      ->addIndexColumn()
        //      ->addColumn('action', function($row){
   
        //     })
        //     ->rawColumns(['action'])
        //      ->make(true);
        // }
        // return view('operationNew.indexoperation',compact('operation'));
        $operation=OperationNew::where('id',$id)->first();
        if($operation){
            $response_data=["success"=>1,"message"=>"successfully","operation"=>$operation];
        }
        else{
            $response_data=["success"=>0,"message"=>"fail","operation"=>$operation];

        }
        
        return view('operationNew.projectview',compact('operation'));
       }
    
        public function usersview(Request $request){
            $user = Auth()->user();
            $users = User::whereNotIn('user_type', ['admin', 'doctor','user'])->latest()->get(); 
            $country=Country::get();
            if($request->ajax()){
                return Datatables::of($users)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
       
                })
                ->rawColumns(['action'])
                 ->make(true);
            }
            
            return view('users',compact('users','country'));
           }
           public function usersdelete($id){
            
            $user=User::where('id',$id)->delete();
            return redirect()->route('usersview');
           }
           
           public function delete_user(Request $req){
            //    dd($req->all());
               $user=User::where('id',$req->delete_id_send)->delete();
               
               if($user){
                $response_data=["success"=>1,"message"=>" Delete successfully"];
               }else{
                 $response_data=["success"=>0,"message"=>"faill"];
               }
               return response()->json($response_data);
           }
           
           public function usersedit($id){
                   $create = User::find($id);
                   return view('usersedit',compact('create'));

               }

           public function usersupdate(Request $req){
               $validator = Validator::make($req->all(),[
                   'newpassword'=>'required',
                   'confirmpassword' =>'required'
               ]);
               if(!$validator->fails()){
                 $create = User::where('id',$req->id)->update(['password'=>Hash::make($req->newpassword)]);

                 if($create){
                     $response_data=["success"=>1,"message"=>"success"];
                 }
                 else{
                    $response_data=["success"=>0,"message"=>"faill"];
                 }
                 
               }
               else{
                $response_data=["success"=>0,"message"=>"validation error"];
               }
               return response()->json($response_data);
           } 
           public function register(Request $req){
              
           $validator=Validator::make($req->all(),[
              'name' =>'required',
              'email' =>'required|email|unique:users,email,',
              'password'=>'required',
              'password_confirmation'=>'required',
              'user_type'=>'required',
              'user_role'=>'required'
           ]);

           if(!$validator->fails()){
               $create = new User();
               $create->name = $req->name;
               $create->email = $req->email;
               $create->country = $req->country;
               $create->password = Hash::make($req->password);
               $create->user_type =$req->user_type;
               $create->user_role=$req->user_role;
               if($create->save()){

                if ($req->user_type === 'global_team' && $req->has('global_manager_id')) {
                    DB::table('global_manager_team')->insert([
                        'global_manager_id' => $req->global_manager_id,
                        'global_team_id' => $create->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                   event(new SendUserMail([$req->email,$req->password]));
                   $response_data=["success"=>1,"message"=>"register Success"];
               }
               else{
                $response_data=["success"=>0,"message"=>"register fail"];
               }
           }
           else{
            $response_data=["success"=>0,"message"=>"validation error" ,"errors" => $validator->errors()];
           }
           return response()->json($response_data);
           }
            public function fieldperfomance(){
               $Team_Leader=User::where('user_role','team_leader')->get();
               $project_manager=User::where('user_role','project_manager')->get();
               $quality_analyst=User::where('user_role','quality_analyst')->get();
               return view('operationNew.perfomance',compact('Team_Leader','project_manager','quality_analyst'));
           }
           public function getfieldperfomance(Request $request){
               if(($request->fid) && ($request->pid) && ($request->qid)){
               $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->where('team_leader',$request->fid)->where('project_manager_name',$request->pid)->where('quality_analyst_name',$request->qid)->count();
                $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->where('team_leader',$request->fid)->where('project_manager_name',$request->pid)->where('quality_analyst_name',$request->qid)->count();
                $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
               }
               elseif($request->pid){
               $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->where('project_manager_name',$request->pid)->count();
               $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->where('project_manager_name',$request->pid)->count();
               $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
               }
               elseif($request->qid){
               $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->where('quality_analyst_name',$request->qid)->count();
               $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->where('quality_analyst_name',$request->qid)->count();
               $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
               }
               elseif($request->fid){
               $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->where('team_leader',$request->fid)->count();
               $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->where('team_leader',$request->fid)->count();
               $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
               }
               else{
                   $response_data=["success"=>0,"message"=>"fail"];
               }
               return response()->json($response_data);
           }
           
            public function operationperfomance(){
               $opeartion=User::where('user_type','operation')->get();
               $all1=User::where('user_type','operation')->select('id')->get()->toArray();
               $all=array();
               for($i=0; $i<count($all1); $i++){
                  array_push($all,$all1[$i]['id']); 
               }
               $all2=(implode(',', $all));
               return view('operationNew.operationperfomance',compact('opeartion','all2'));
           }
           
           public function getoperationperfomance(Request $request){
               if($request->id){
              if(is_numeric($request->id)){
                // dd($request->all());
               $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->where('user_id',$request->id)->count();
               $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->where('user_id',$request->id)->count();
               $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
              }
               else{
                  $all1=$request->id;
                  $all=array();
                  $all=explode(',',$all1);
                //   dd($all);
                $newProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','hold')->whereIn('user_id',$all)->count();
               $closeProject=OperationNew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('status','completed')->whereIn('user_id',$all)->count();
               $response_data=["success"=>1,"message"=>"success","newProject"=>$newProject,"closeProject"=>$closeProject];
                //   $response_data=["success"=>0,"message"=>"fail"];
               }
               }
               else{
                   $response_data=["success"=>0,"message"=>"fail"];
               }
               return response()->json($response_data);
           }
           public function operationperformancefilter(Request $request){
             $data=$request->all();
            
             $opr=$data['opeartion'];
            //  dd(is_numeric($opr));
            
             $operation=OperationNew::latest();
            
             if($data['daterange']!=''){
             $date=explode("-",$data['daterange']);
             $startdate= date("Y-m-d", strtotime($date[0])); 
             $enddate=date("Y-m-d", strtotime($date[1]));
             if(is_numeric($opr)){
              if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($opr) && $opr!='')) && ((isset($data['close']) && $data['close']!=''))){
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
              $operation->where('user_id',$opr);  
              $operation->where('status',$data['close']);  
             }
             }
             else{
                 $opr1=array();
                $opr1=explode(',',$opr);
                // dd($opr1);
                if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($opr1) && $opr1!='')) && ((isset($data['close']) && $data['close']!=''))){
                $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
                $operation->whereIn('user_id',$opr1);  
                $operation->where('status',$data['close']);  
                }
             }
             }
           if($request->ajax()){
              return Datatables::of($operation->get())
               ->addIndexColumn()
               ->addColumn('action', function($row){
   
              })
              ->rawColumns(['action'])
               ->make(true);
           }
        }
        
        public function operationnewperformancefilter(Request $request){
             $data=$request->all();
             $opr=$data['op'];
             $operation=OperationNew::latest();
             if($data['daterange']!=''){
             $date=explode("-",$data['daterange']);
             $startdate= date("Y-m-d", strtotime($date[0])); 
             $enddate=date("Y-m-d", strtotime($date[1]));
             if(is_numeric($opr)){
               if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($data['op']) && $data['op']!='')) && ((isset($data['new']) && $data['new']!=''))){
                $operation->where('user_id',$data['op']);  
                $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
                $operation->where('status',$data['new']);  
               }
             }
             else{
                 $opr1=array();
                 $opr1=explode(',',$opr);
                 if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($opr1) && $opr1!='')) && ((isset($data['new']) && $data['new']!=''))){
                $operation->whereIn('user_id',$opr1);  
                $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
                $operation->where('status',$data['new']);  
               }
             }
             }
           if($request->ajax()){
              return Datatables::of($operation->get())
               ->addIndexColumn()
               ->addColumn('action', function($row){
   
              })
              ->rawColumns(['action'])
               ->make(true);
           }
       }
       
        //   field perfomance
           public function fieldperformancefilter(Request $request){
            $data=$request->all();
            
          $operation=OperationNew::latest();
          $date=explode("-",$data['daterange']);
          $startdate= date("Y-m-d", strtotime($date[0])); 
          $enddate=date("Y-m-d", strtotime($date[1]));
          
         if(((isset($data['tid']) && $data['tid']!='')) && ((isset($data['pid']) && $data['pid']!='')) && ((isset($data['qid']) && $data['qid']!='')) && ((isset($data['field']) && $data['field']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('team_leader',$data['tid']);  
              $operation->where('project_manager_name',$data['pid']);  
              $operation->where('quality_analyst_name',$data['qid']);  
              $operation->where('status',$data['field']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          } 
         elseif(((isset($data['tid']) && $data['tid']!='')) && ((isset($data['field']) && $data['field']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('team_leader',$data['tid']);  
              $operation->where('status',$data['field']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
          elseif(((isset($data['pid']) && $data['pid']!='')) && ((isset($data['field']) && $data['field']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('project_manager_name',$data['pid']);  
              $operation->where('status','Like',$data['field']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
          elseif(((isset($data['qid']) && $data['qid']!='')) && ((isset($data['field']) && $data['field']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('quality_analyst_name',$data['qid']);  
              $operation->where('status',$data['field']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
           if($request->ajax()){
               return Datatables::of($operation->get())
                ->addIndexColumn()
                ->addColumn('action', function($row){
   
               })
              ->rawColumns(['action'])
               ->make(true);
          }
          }
           
         public function closedperformancefilter(Request $request){
            $data=$request->all();
            
          $operation=OperationNew::latest();
          $date=explode("-",$data['daterange']);
          $startdate= date("Y-m-d", strtotime($date[0])); 
          $enddate=date("Y-m-d", strtotime($date[1]));
          
         if(((isset($data['tid']) && $data['tid']!='')) &&  ((isset($data['pid']) && $data['pid']!='')) && ((isset($data['qid']) && $data['qid']!='')) && ((isset($data['close']) && $data['close']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('team_leader',$data['tid']);  
              $operation->where('project_manager_name',$data['pid']);  
              $operation->where('quality_analyst_name',$data['qid']);  
              $operation->where('status',$data['close']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          } 
         elseif(((isset($data['tid']) && $data['tid']!='')) && ((isset($data['close']) && $data['close']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('team_leader',$data['tid']);  
              $operation->where('status',$data['close']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
          elseif(((isset($data['pid']) && $data['pid']!='')) && ((isset($data['close']) && $data['close']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('project_manager_name',$data['pid']);  
              $operation->where('status',$data['close']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
          elseif(((isset($data['qid']) && $data['qid']!='')) && ((isset($data['close']) && $data['close']!='')) && ((isset($startdate) && $startdate!='' && ($enddate) && $enddate!=''))) {
              $operation->where('quality_analyst_name',$data['qid']);  
              $operation->where('status',$data['close']); 
              $operation->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
          }
           if($request->ajax()){
               return Datatables::of($operation->get())
                ->addIndexColumn()
                ->addColumn('action', function($row){
   
               })
              ->rawColumns(['action'])
               ->make(true);
          }
       
           }
           public function commonviewperformance($id,OperationNew $operation){
           $country=Country::get();
           $fieldteam=Fieldteam::get();
           $user=User::where('user_role','team_leader')->get();
           $user1=User::where('user_role','project_manager')->get();
           $user2=User::where('user_role','quality_analyst')->get();
           $operation=OperationNew::with('operationNewImage')->where('id',$id)->first();
           return view('operationNew.commonviewperformance',compact('operation','country','fieldteam','user','user1','user2'));
           }
           public function commonoperationviewperformance($id,OperationNew $operation){
           $country=Country::get();
           $fieldteam=Fieldteam::get();
           $user=User::where('user_role','team_leader')->get();
           $user1=User::where('user_role','project_manager')->get();
           $user2=User::where('user_role','quality_analyst')->get();
           $operation=OperationNew::with('operationNewImage')->where('id',$id)->first();
           return view('operationNew.commonoperationviewperformance',compact('operation','country','fieldteam','user','user1','user2'));
           }
           

        public function operationOverview()
        {
            $closed = "";
            
            $user = Auth::user();
            $new = "";
            $operation = OperationNew::whereNotIn('status', ['completed', 'stop'])->get();
            $tl=User::where('user_role','team_leader')->get();
            $pl=User::where('user_role','project_manager')->get();
            $ql=User::where('user_role','quality_analyst')->get();
            $oh=User::where('user_role','operation_head')->get();
            $operation->transform(function ($item) use ($user) {
                $createdAt = Carbon::parse($item->created_at);
                $updatedAt = Carbon::parse($item->updated_at);
            
                // Assume updated_at is only valid if it changed from created_at
                if ($updatedAt->ne($createdAt)) {
                    // Fetch last version of this record before update using DB
                    $history = DB::table('operation_new') // Replace 'operations' with your actual table
                        ->where('id', $item->id)
                        ->first();
            
                    // Check if the project_manager_name is now equal to the current user ID
                    if ($item->project_manager_name == $user->id) {
                        $item->display_date = $updatedAt->format('d-m-Y');
                    } else {
                        $item->display_date = $createdAt->format('d-m-Y');
                    }
                } else {
                    $item->display_date = $createdAt->format('d-m-Y');
                }
                  
                return $item;
            });
            return view('operation_head',compact('operation','closed','new','tl','pl','ql','oh'));
        }



        public function updateStatus(Request $request)
        {
            $operation = OperationNew::find($request->id);
            $operation->status = $request->status;
            $operation->save();
            $response_data=["success"=>1,"message"=>"Updated Successfully"];
            return response()->json($response_data);
        }

        public function operationPmOverview()
        {
            $closed = "";
            
            $user = Auth::user();
            $new = "";
            $operation = OperationNew::whereNotIn('status', ['completed', 'stop'])->get();
            $tl=User::where('user_role','team_leader')->get();
            $pl=User::where('user_role','project_manager')->get();
            $ql=User::where('user_role','quality_analyst')->get();
            $oh=User::where('user_role','operation_head')->get();
            $operation->transform(function ($item) use ($user) {
                $createdAt = Carbon::parse($item->created_at);
                $updatedAt = Carbon::parse($item->updated_at);
            
                // Assume updated_at is only valid if it changed from created_at
                if ($updatedAt->ne($createdAt)) {
                    // Fetch last version of this record before update using DB
                    $history = DB::table('operation_new') // Replace 'operations' with your actual table
                        ->where('id', $item->id)
                        ->first();
            
                    // Check if the project_manager_name is now equal to the current user ID
                    if ($item->project_manager_name == $user->id) {
                        $item->display_date = $updatedAt->format('d-m-Y');
                    } else {
                        $item->display_date = $createdAt->format('d-m-Y');
                    }
                } else {
                    $item->display_date = $createdAt->format('d-m-Y');
                }
                  
                return $item;
            });
            return view('operationdashboard',compact('operation','closed','new','tl','pl','ql','oh'));
        }


        public function delete($id)
        {
            DB::beginTransaction();

            try {
                $operation = OperationNew::findOrFail($id);
        
                // ✅ Step 1: Extract base RFQ code
                $rfqFull = $operation->rfq;
                $rfq = explode('_', $rfqFull)[0]; // e.g., "RFQ46-2025"
        
                // ✅ Step 2: Get all rfq_details related to this RFQ
                $details = RfqDetailsTable::where('rfq_no', $rfq)->get();
        
                foreach ($details as $detail) {
                    $detailId = $detail->id;
        
                    // ✅ Step 3: Delete related child entries
                    RfqSingleCountry::where('rfq_details_id', $detailId)->delete();
                    RfqMultipleCountry::where('rfq_details_id', $detailId)->delete();
                    RfqInterviewDepth::where('rfq_details_id', $detailId)->delete();
                    RfqOnlineCommunity::where('rfq_details_id', $detailId)->delete();
        
                    // Delete rfq_detail
                    $detail->delete();
                }
        
                // ✅ Step 4: Delete related models using full rfq
                WonProject::where('rfq_no', $rfqFull)->delete();
                ClientRequest::where('rfq', $rfqFull)->delete();
                Vendorrequestadvance::where('rfq', $rfqFull)->delete();
        
                // ✅ Step 5: Delete the main operation
                $operation->delete();
        
                DB::commit();
                return response()->json(['message' => 'RFQ and all related data deleted successfully.']);
        
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Error deleting data: ' . $e->getMessage()
                ], 500);
            }
        }
        public function getProjectCompletionData($operationId)
        {
            $data = Procompleted::where('operation_id', $operationId)->first();
        
            if (!$data) {
                return response()->json(['success' => false, 'message' => 'No data found']);
            }
        
            return response()->json([
                'success' => true,
                'data' => $data,
                'files' => [
                    'respondentfile' => $data->respondentfile ?? null,
                    'clientinvoicefile' => $data->clientinvoicefile ?? null,
                    'vendorinvoicefile' => $data->vendorinvoicefile ?? null,
                    'client_confirmation' => $data->client_confirmation ?? null,
                    'vendor_confirmation' => $data->vendor_confirmation ?? null,
                ]
            ]);
        }

        public function OverviewClosed()
        {    
            
            $user =  Auth()->user(); // get current logged in user

            // Start building query
            $query = OperationNew::whereIn('status', ['completed', 'stop']);

            // If the logged in user is a project manager, filter accordingly
            if ($user->user_role === 'project_manager') {
                $query->where('project_manager_name', $user->id);
            }

            $operation = $query->get();
             $pl=User::where('user_role','project_manager')->get();
             $oh=User::where('user_role','operation_head')->get();
             return view('operationNew.overviewclosed',compact('operation','pl'));
        }
        
 }
