<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\Client;
use App\Models\ProjectsComments;
use App\Models\WonProject;
use App\Models\BidRfq;
use App\Models\RfqDetailsTable;
use App\Models\RfqSingleCountry;
use App\Models\RfqMultipleCountry;
use App\Models\RfqInterviewDepth;
use App\Models\RfqOnlineCommunity;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;




use Yajra\DataTables\DataTables;

class BidRfqController extends Controller
{

   public function index(Request $request)
    {
      
        
        $data = $request->all();
       $bidRfqQuery = RfqDetailsTable::with('single', 'multiple', 'interview', 'online')->where('type', 'next'); // Base query
        // dd($bidRfqQuery->get());
        $user = Auth::user(); // Get authenticated user

        if ($user->user_type == 'sales') {
            // Sales users see only their assigned BidRfq data
            $bidRfqQuery->where('user_id', $user->id);
        }

        // Fetch latest records
        $bidRfq = $bidRfqQuery->latest();
        if(isset($data['rfq_no']) && $data['rfq_no']!=''){
            $bidRfq->where('rfq_no','like','%'.$data['rfq_no'].'%');
            

        }
        if (!empty($data['client_name'])) {
            $bidRfq->where(function ($query) use ($data) {
                $query->orWhereHas('singleClient', function ($q) use ($data) {
                    $q->where('client_name', 'like', '%' . $data['client_name'] . '%'); 
                })->orWhereHas('multipleClient', function ($q) use ($data) {
                    $q->where('client_name', 'like', '%' . $data['client_name'] . '%');
                })->orWhereHas('interviewDepthClient', function ($q) use ($data) {
                    $q->where('client_name', 'like', '%' . $data['client_name'] . '%');
                })->orWhereHas('onlineCommunityClient', function ($q) use ($data) {
                    $q->where('client_name', 'like', '%' . $data['client_name'] . '%');
                });
            });
        }
         if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
            $bidRfq->whereBetween('date',[$data['startdate'],$data['enddate']]);
        }
         if(isset($data['industry']) && $data['industry']!=''){
            $bidRfq->where('industry','like','%'.$data['industry'].'%');
        }
        // if(isset($data['order']) && $data['order'] ){
        //   $bidRfq->orderBy('created_at', 'desc');
        //  }
        
        
    //   dd($request->order[0]['column']);
       
       
        
        
    if ($user->user_type == 'admin') {
        // Admin sees all vendors and clients
        $vendor = Vendor::all();
        $client = Client::all();
    } else {
        // Sales users only see data linked to their user ID
        $vendor = Vendor::where('user_id', $user->id)->get();
        $client = Client::where('user_id', $user->id)->get();
    }
        $country = Country::get();
        $user = Auth()->user();
        
        if ($request->ajax()) {
            return Datatables::of($bidRfq->get())
            
            
                 
                     
                    
                    ->addIndexColumn()
                    
                    
                    
                    ->addColumn('action', function($row){
   
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true);
                    
        }else{
            $unique_no = RfqDetailsTable::orderBy('id', 'DESC')->pluck('id')->first();
         if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 1;
            $dt = Carbon::now();
        //  var_dump($dt->year);
         }
         else{
             #If Table has Already some Data
             $unique_no = $unique_no + 1;
             $dt = Carbon::now();
            //  var_dump($dt->year);
        }
         $rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        $rfqno = $rfq_no;
            

            
       

            return view('bidrfq.index',compact('bidRfq','client','country','vendor','rfqno'));
        
            
        }
      
    }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function create()
    {   
        $user = Auth::user(); 
        $bidrfq="";
        $bidrfq=[];
        $country = Country::get();
        if ($user->user_type == 'admin') {
            // Admin sees all vendors and clients
            $vendor = Vendor::all();
            $client = Client::all();
        } else {
            // Sales users only see data linked to their user ID
            $vendor = Vendor::where('user_id', $user->id)->get();
            $client = Client::where('user_id', $user->id)->get();
        }
        $unique_no = BidRfq::orderBy('id', 'DESC')->with('rfq_no','rfq_no')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        
        // $rfqno = $bidrfq->rfq_no;
        // dd($rfq_no);
        return view('bidrfq.create',compact('bidrfq','rfq_no','client','vendor','country'));
    }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
    public function store(Request $req)
    {
        $response_data = [];
        // dd($req->all());
       
        
        $validator = Validator::make($req->all(), [ 
            
               'country_0.*'  => 'required',
               'client_id_0.*' => 'required',
               "vendor_id_0.*" => "required",
               
              
        ]);
    
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
          for($i=0; $i<$req->bidrfqCount; $i++)
            {
                $bidrfq = new BidRfq();
                $client_id = 'client_id_'.$i;
                $vendor_id = 'vendor_id_'.$i;
                $sample_size = 'sample_size_'.$i;
                $setup_cost = 'setup_cost_'.$i;
                $recruitment = 'recruitment_'.$i;
                $incentives = 'incentives_'.$i;
                $moderation = 'moderation_'.$i;
                $transcript = 'transcript_'.$i;
                $others = 'others_'.$i;
                $country = 'country_'.$i;
                $total_cost = 'total_cost_'.$i;
                $bidrfq->date = $req->date;
                $bidrfq->industry = $req->industry;
                $bidrfq->comments = $req->comments;
                $bidrfq->follow_up_date = $req->follow_up_date;
                $bidrfq->currency = $req->currency;
                $bidrfq->company_name = $req->company_name;
                $bidrfq->respondent_title = $req->respondent_title;
                $bidrfq->interview_length = $req->interview_length;
                $bidrfq->others_field = $req->others_field;
                $bidrfq->rfq_no = $req->rfq_no;
                
                $bidrfq->client_id =json_encode($req->client_id_0);
                // $bidrfq->client_id =json_encode($req->client_id_0);
                $bidrfq->vendor_id = json_encode($req->vendor_id_0);
                // dd($bidrfq->vendor_id);
                $bidrfq->country = json_encode($req->country_0);
                $bidrfq->methodology = json_encode($req->methodology_0);
                $bidrfq->sample_size = json_encode($req->sample_size_0);    
                $bidrfq->setup_cost =json_encode($req->setup_cost_0);
                $bidrfq->recruitment = json_encode($req->recruitment_0);
                $bidrfq->incentives = json_encode($req->incentives_0);
                $bidrfq->moderation  = json_encode($req->moderation_0);
                $bidrfq->transcript = json_encode($req->transcript_0);
                $bidrfq->others = json_encode($req->others_0);
                $bidrfq->total_cost = json_encode($req->total_cost_0);
                $bidrfq->user_id = auth()->user()->id;

                $unique_no = BidRfq::orderBy('id', 'DESC')->with('rfq_no','rfq_no')->pluck('id')->first();
                if($unique_no == null or $unique_no == ""){
                    #If Table is Empty
                    $unique_no = 1;
                    $dt = Carbon::now();
                }
                else{
                    #If Table has Already some Data
                    $unique_no = $unique_no + 1;
                    $dt = Carbon::now();
                }
                $rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        
                if ($bidrfq->save()) {
                    $response_data = ["success" => 1, "message" => "RfqBid Created Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }
    
    public function edit($id,Bidrfq $bidrfq)
    {
        $wonproject= WonProject::select('rfq_no')->get()->toArray();
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $bidrfq = BidRfq::where('id', $id)->first();
        $rfq = array();
        $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('id',$id)->first();
        for($i=0; $i< count($wonproject);$i++)
        {
            array_push($rfq,$wonproject[$i]['rfq_no']);
        }
        return view('bidrfq.edit',compact('bidrfq','client','vendor','country','id','wonproject','rfq','newrfq'));
    }
    
    public function update(Request $request)
    {
         //dd($request->all());
        
        // dd($v);
      $v = $request->all();
        
        $response_data = [];
        $validator = Validator::make($request->all(), [ 
          
            'date' => 'required|date',
            'industry' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'follow_up_date' => 'nullable|date',
      
     ]);
        
     if ($validator->fails()) {
        return response()->json([
            "success" => 0,
            "message" => "Validation Error",
            "errors" => $validator->errors()
        ], 422);
    }
        //   dd($request->all());
        $rfq = RfqDetailsTable::find($request->id);
        $rfq->date = $request->date;
        $rfq->industry = $request->industry;
        $rfq->follow_up_date = $request->follow_up_date;
        $rfq->company_name = $request->company_name;
        $rfq->rfq_no = $request->rfq_no;
        $rfq->user_id = auth()->user()->id;
        if ($rfq->save()) {
         
            if($request->single_form == 1)
            {
                $single = RfqSingleCountry::where('rfq_details_id', $rfq->id)->first();

                if(!isset($single))
                {
                    $single = new RfqSingleCountry();
                }
                if ($single) {
                    $single->rfq_details_id = $rfq->id;
                    $single->single_methodology = json_encode($request->single_methodology);
                    $single->single_currency = json_encode($request->single_currency);
                    $single->single_loi = json_encode($request->single_loi);
                    $single->single_country = json_encode($request->single_country);
                    $single->single_client = json_encode($request->single_client);
                    $single->single_sample = json_encode($request->single_sample);
                    $single->single_fieldwork = json_encode($request->single_fieldwork);
                    $single->single_other = json_encode($request->single_other);
                    $single->single_total_cost = json_encode($request->single_total_cost);
                    $single->user_id = auth()->user()->id;
                    $single->save();
                }
            }else{
                RfqSingleCountry::where('rfq_details_id', $rfq->id)->delete();
            }
            if($request->multiple_form == 1)
            {
                $multiple = RfqMultipleCountry::where('rfq_details_id', $rfq->id)->first();
                if(!isset($multiple))
                {
                    $multiple = new RfqMultipleCountry();
                }
                //dd($multiple);
                if ($multiple) {
               
                $multiple->rfq_details_id = $rfq->id;
                $multiple->multiple_methodology = json_encode($request->multiple_methodology);
                $multiple->multiple_currency = json_encode($request->multiple_currency);
                $multiple->multiple_loi = json_encode($request->multiple_loi);
                $multiple->multiple_client = json_encode($request->multiple_client);
                $multiple->multiple_countries = json_encode($request->multiple_countries);
                $multiple->multiple_other = json_encode($request->multiple_other);
                $multiple->multiple_total_cost = json_encode($request->multiple_total_cost);
                $multiple->user_id = auth()->user()->id;
                $multiple->save();
                }
            }else{
                RfqMultipleCountry::where('rfq_details_id', $rfq->id)->delete();
            }
            if($request->interview_form == 1)
            {
                
                $interview = RfqInterviewDepth::where('rfq_details_id', $rfq->id)->first();
                if(!isset($interview))
                {
                    $interview = new RfqInterviewDepth();
                }
                if($interview){
                $interview->rfq_details_id = $rfq->id;
                $interview->interview_depth_methodology = json_encode($request->interview_depth_methodology);
                $interview->interview_depth_currency = json_encode($request->interview_depth_currency);
                $interview->interview_depth_loi = json_encode($request->interview_depth_loi);
                $interview->interview_depth_client = json_encode($request->interview_depth_client);
                $interview->interview_depth_no_fgd = json_encode($request->interview_depth_fgd);
                $interview->interview_depth_sample_fgd = json_encode($request->interview_depth_sample_fgd);
                $interview->interview_depth_countries = json_encode($request->interview_depth_countries);
                $interview->interview_depth_requirements = json_encode($request->interview_depth_requirement);
                $interview->interview_depth_incentives = json_encode($request->interview_depth_incentives);
                $interview->interview_depth_moderation = json_encode($request->interview_depth_moderation);
                $interview->interview_depth_transcripts = json_encode($request->interview_depth_transcripts);
                $interview->interview_depth_project_management = json_encode($request->interview_depth_project_management);
                $interview->interview_depth_other = json_encode($request->interview_depth_other);
                $interview->interview_depth_total_cost_1 = json_encode($request->interview_depth_total_cost_1);
                $interview->interview_depth_total_cost_2 = json_encode($request->interview_depth_total_cost_2);
                $interview->user_id = auth()->user()->id;
                $interview->save();
                }
            }else{
                RfqInterviewDepth::where('rfq_details_id', $rfq->id)->delete();
            }
            if($request->online_form == 1)
            {
                $online= RfqOnlineCommunity::where('rfq_details_id', $rfq->id)->first();
                if(!isset($online))
                {
                    $online = new RfqOnlineCommunity();
                }
                if($online)
                {
                $online->rfq_details_id = $rfq->id;
                $online->online_community_methodology = json_encode($request->online_community_methodology);
                $online->online_community_currency = json_encode($request->online_community_currency);
                $online->online_community_duration = json_encode($request->online_community_duration);
                $online->online_community_loi_screener = json_encode($request->online_community_loi_screener);
                $online->online_community_sample_loi_month = json_encode($request->online_community_loi_month);
                $online->online_community_client = json_encode($request->online_community_client);
                $online->online_community_countries = json_encode($request->online_community_countries);
                $online->online_community_requirements = json_encode($request->online_community_requirements);
                $online->online_community_incentives = json_encode($request->online_community_incentives);
                $online->online_community_pmfree = json_encode($request->online_community_pmfree);
                $online->online_community_other = json_encode($request->online_community_other);
                $online->online_community_total_cost = json_encode($request->online_community_total_cost);
                $online->user_id = auth()->user()->id;
                $online->save();
                }
            }else{
                RfqOnlineCommunity ::where('rfq_details_id', $rfq->id)->delete();
            }
            return response()->json([
                "success" => 1,
                "message" => "RFQ saved successfully",
                "rfq_id" => $rfq->id
            ], 200);
         } 
        
                return response()->json([
                    "success" => 0,
                    "message" => "Failed to save RFQ"
                ], 500);

        
    }

    
    public function Followupdate(Request $req)
    {
     
        $response_data = [];
        $validator = Validator::make($req->all(),[
            'follow_up_date'=> 'required',
            'comments'=>'required',
            ]
           
        );
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
                $bidrfq = RfqDetailsTable::where('id', $req->id) 
                ->update(['comments' => $req->comments,'follow_up_date' => $req->follow_up_date,'type'=>'lost']); 
                
                // $value = Bidrfq::get();
                // dd($bidrfq);
                if ($bidrfq) {
                    $response_data = ["success" => 1, "message" => "Lost Project Updated Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            
        } else {
            $response_data = ["success" => 0, "message" => "Plese Fill Fields", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }
    public function nextFollowupdate(Request $req)
    {
        $response_data = [];
         $validator = Validator::make($req->all(),[
            'follow_up_date'=> 'required',
            'comments'=>'required',
            ]
           
        );
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
                $bidrfq = RfqDetailsTable::where('id', $req->id) 
                ->update(['comments' => $req->comments,'follow_up_date' => $req->follow_up_date,'type'=>'next']); 
                
                // $value = Bidrfq::get();
                // dd($bidrfq);
                if ($bidrfq) {
                    $response_data = ["success" => 1, "message" => "Next Follow up Updated Successfully"];
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

        $rfq = RfqDetailsTable::with(['single', 'multiple', 'interview', 'online'])
        ->where('id', $id)
        ->firstOrFail();

            // Delete related records manually if they exist
            if ($rfq->single) {
                $rfq->single()->delete();
            }
            if ($rfq->multiple) {
                $rfq->multiple()->delete();
            }
            if ($rfq->interview) {
                $rfq->interview()->delete();
            }
            if ($rfq->online) {
                $rfq->online()->delete();
            }

            // Now delete the main record
            $rfq->delete();

        if($rfq)
        {
            $response_data = ["success" => 1, "message" => "RFQ Deleted Successfully"];
            return redirect()->route('bidrfq.index');
        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }

        return response()->json($response_data);
        
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        
        if($user->user_type=="admin"){
            $bidrfq = BidRfq::paginate(5);
        }else{
            $bidrfq = BidRfq::where('user_id',$user->id)->paginate(5);
        }
        // dd($bidrfq);
        #Store Unique Order/Product Number
        $unique_no = BidRfq::where('user_id',$user)->orderBy('id', 'DESC')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $bidrfq->rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        $rfqno = $bidrfq->rfq_no;
        // dd($bidrfq->rfq_no);
       

        $bidrfqfilter = new BidRfq();

        if ($request->has('rfq_no')) {
            $bidrfqfilter->where('rfq_no', $request->input('rfq_no'));
        }

        if ($request->has('date')) {
            $bidrfqfilter->where('date', $request->input('date'));
        }

        if ($request->has('client_name')) {
            $bidrfqfilter->where('client_name', $request->input('client_name'));
        }

        if ($request->has('industry') && $request->industry!= "" ) {
            $bidrfqfilter->where('industry', $request->input('industry'));
        }

        if ($request->has('follow_up_date')) {
            $bidrfqfilter->where('follow_up_date', $request->input('follow_up_date'));
        }

        // Get the results and return them.
        // return $bidrfqfilter->paginate(5);
        return view('bidrfq.bidrfqfilter', compact('bidrfq','bidrfqfilter','rfqno'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function getFollow()
    {
        $user = Auth::user();
        $follow="";
       if($user->user_type=="admin"){
            $bidrfq = BidRfq::where('type','next')->orderBy('id', 'DESC')->paginate(5);
        }else{
            $bidrfq = BidRfq::where('type','next')->where('user_id',$user->id)->paginate(5);
        }
        // dd($bidrfq);
        #Store Unique Order/Product Number
        $unique_no = BidRfq::where('user_id',$user)->orderBy('id', 'DESC')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $bidrfq->rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        $rfqno = $bidrfq->rfq_no;
        $comment = ProjectsComments::get();
        return view('bidrfq.followup',compact('bidrfq','follow', 'comment','rfqno' ));
    }
    public function lostProject(Request $request)
    {
       $data=$request->all();
     

       $user = Auth::user(); // Get authenticated user
       
       // Base query for fetching 'lost' type BidRfq records
       $bidrfq = RfqDetailsTable::where('type', 'lost')->latest();
       
       // Apply filtering for sales users
       if ($user->user_type == 'sales') {
           $bidrfq->where('user_id', $user->id);
       }
       
       // Execute the query
       $bidrfq = $bidrfq;
       
       if(isset($data['rfq_no'])&& $data['rfq_no']!= ''){
        $bidrfq->where('rfq_no','like','%'.$data['rfq_no'].'%');
        }
        if(isset($data['industry']) && $data['industry']!=''){
            $bidrfq->where('industry','like','%'.$data['industry'].'%');
        }
        if(isset($data['client_id']) && $data['client_id']!=''){
            $bidrfq->where('client_id','like','%'.$data['client_id'].'%');
        }
        if(isset($data['start_date']) && $data['start_date'] !='' && ($data['end_date'])  && $data['end_date']!=''){
            $bidrfq->whereBetween('date',[$data['start_date'],$data['end_date']]);
        }
        $user = Auth::user();
        $client = Client::get();
      
        if ($request->ajax()) {
            return Datatables::of($bidrfq)            
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
   
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true);
                    
        }
        else{
        $unique_no = RfqDetailsTable::where('user_id',$user)->orderBy('id', 'DESC')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            #If Table is Empty
            $unique_no = 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        else{
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
            // var_dump($dt->year);
        }
        $bidrfq->rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        $rfqno = $bidrfq->rfq_no;
        $comment = ProjectsComments::get();
        return view('bidrfq.lostprojectlist',compact('bidrfq','client'));
       }
    }
    public function lostProjectView($id){
      
        $wonproject= WonProject::select('rfq_no')->get()->toArray();
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $bidrfq = RfqDetailsTable::where('id', $id)->first();
        $rfq = array();
        for($i=0; $i< count($wonproject);$i++)
        {
            array_push($rfq,$wonproject[$i]['rfq_no']);
        }
        return view('bidrfq.lostview',compact('bidrfq','client','vendor','country','id','wonproject','rfq'));
    }
     public function wonupdate(Request $request)
    {
         //dd($request->all());
        
        // dd($v);
        $v = $request->all();
        
        $response_data = [];
        $validator = Validator::make($request->all(), [ 
          
            'date' => 'required|date',
            'industry' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'follow_up_date' => 'nullable|date',
      
     ]);
        
     if ($validator->fails()) {
        return response()->json([
            "success" => 0,
            "message" => "Validation Error",
            "errors" => $validator->errors()
        ], 422);
    }
         // dd($req->bidrfqCount);
        $rfq = RfqDetailsTable::find($request->id);
        $rfq->date = $request->date;
        $rfq->industry = $request->industry;
        $rfq->follow_up_date = $request->follow_up_date;
        $rfq->company_name = $request->company_name;
        $rfq->rfq_no = $request->rfq_no;
        $rfq->user_id = auth()->user()->id;
        if ($rfq->save()) {
         
            if($request->single_form == 1)
            {
                $single = RfqSingleCountry::where('rfq_details_id', $rfq->id)->first();
                if ($single) {
                    $single->rfq_details_id = $rfq->id;
                    $single->single_methodology = json_encode($request->single_methodology);
                    $single->single_currency = json_encode($request->single_currency);
                    $single->single_loi = json_encode($request->single_loi);
                    $single->single_country = json_encode($request->single_country);
                    $single->single_client = json_encode($request->single_client);
                    $single->single_sample = json_encode($request->single_sample);
                    $single->single_fieldwork = json_encode($request->single_fieldwork);
                    $single->single_other = json_encode($request->single_other);
                    $single->single_total_cost = json_encode($request->single_total_cost);
                    $single->user_id = auth()->user()->id;
                    $single->save();
                }
            }
            if($request->multiple_form == 1)
            {
                $multiple = RfqMultipleCountry::where('rfq_details_id', $rfq->id)->first();
                if ($multiple) {
               
                $multiple->rfq_details_id = $rfq->id;
                $multiple->multiple_methodology = json_encode($request->multiple_methodology);
                $multiple->multiple_currency = json_encode($request->multiple_currency);
                $multiple->multiple_loi = json_encode($request->multiple_loi);
                $multiple->multiple_client = json_encode($request->multiple_client);
                $multiple->multiple_countries = json_encode($request->multiple_countries);
                $multiple->multiple_other = json_encode($request->multiple_other);
                $multiple->multiple_total_cost = json_encode($request->multiple_total_cost);
                $multiple->user_id = auth()->user()->id;
                $multiple->save();
                }
            }
            if($request->interview_form == 1)
            {

                $interview = RfqInterviewDepth::where('rfq_details_id', $rfq->id)->first();
                if($interview){
                $interview->rfq_details_id = $rfq->id;
                $interview->interview_depth_methodology = json_encode($request->interview_depth_methodology);
                $interview->interview_depth_currency = json_encode($request->interview_depth_currency);
                $interview->interview_depth_loi = json_encode($request->interview_depth_loi);
                $interview->interview_depth_client = json_encode($request->interview_depth_client);
                $interview->interview_depth_no_fgd = json_encode($request->interview_depth_fgd);
                $interview->interview_depth_sample_fgd = json_encode($request->interview_depth_sample_fgd);
                $interview->interview_depth_countries = json_encode($request->interview_depth_countries);
                $interview->interview_depth_requirements = json_encode($request->interview_depth_requirement);
                $interview->interview_depth_incentives = json_encode($request->interview_depth_incentives);
                $interview->interview_depth_moderation = json_encode($request->interview_depth_moderation);
                $interview->interview_depth_transcripts = json_encode($request->interview_depth_transcripts);
                $interview->interview_depth_project_management = json_encode($request->interview_depth_project_management);
                $interview->interview_depth_other = json_encode($request->interview_depth_other);
                $interview->interview_depth_total_cost_1 = json_encode($request->interview_depth_total_cost_1);
                $interview->interview_depth_total_cost_2 = json_encode($request->interview_depth_total_cost_2);
                $interview->user_id = auth()->user()->id;
                $interview->save();
                }
            }
            if($request->online_form == 1)
            {
                $online= RfqOnlineCommunity::where('rfq_details_id', $rfq->id)->first();
                if($online)
                {
                $online->rfq_details_id = $rfq->id;
                $online->online_community_methodology = json_encode($request->online_community_methodology);
                $online->online_community_currency = json_encode($request->online_community_currency);
                $online->online_community_duration = json_encode($request->online_community_duration);
                $online->online_community_loi_screener = json_encode($request->online_community_loi_screener);
                $online->online_community_sample_loi_month = json_encode($request->online_community_loi_month);
                $online->online_community_client = json_encode($request->online_community_client);
                $online->online_community_countries = json_encode($request->online_community_countries);
                $online->online_community_requirements = json_encode($request->online_community_requirements);
                $online->online_community_incentives = json_encode($request->online_community_incentives);
                $online->online_community_pmfree = json_encode($request->online_community_pmfree);
                $online->online_community_other = json_encode($request->online_community_other);
                $online->online_community_total_cost = json_encode($request->online_community_total_cost);
                $online->user_id = auth()->user()->id;
                $online->save();
                }
            }
            return response()->json([
                "success" => 1,
                "message" => "RFQ saved successfully",
                "rfq_id" => $rfq->id
            ], 200);
         } 
        
                return response()->json([
                    "success" => 0,
                    "message" => "Failed to save RFQ"
                ], 500);
    
        return response()->json($response_data);
    }
     public function pdfview($id){
        
        $newrfq=RfqDetailsTable::with('single','multiple','interview','online')->where('id',$id)->first();
        $vendor = Vendor::get();
        $client = Client::get();
        return view('bidrfq.pdfbidrfq',compact('newrfq','vendor','client'));
        
    }

    public function downloadpdf($id){
        // dd($id);
        $newrfq=RfqDetailsTable::with('single','multiple','interview','online')->where('id',$id)->first();
       //dd($newrfq); 
        $vendor = Vendor::get();
        $client = Client::get();
        $path = 'assets/images/logo-2.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = Pdf::loadView('bidrfq.pdfdownload',compact('newrfq','vendor','client','data','logo'))->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->download('pdf_file.pdf');

    }
}
