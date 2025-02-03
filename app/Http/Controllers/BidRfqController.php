<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\Client;
use App\Models\ProjectsComments;
use App\Models\WonProject;
use App\Models\BidRfq;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use DB;

use Yajra\DataTables\DataTables;

class BidRfqController extends Controller
{

   public function index(Request $request)
    {
      
        
        $data = $request->all();
        $bidRfq = BidRfq::where('type','next')->latest();
        if(isset($data['rfq_no']) && $data['rfq_no']!=''){
            $bidRfq->where('rfq_no','like','%'.$data['rfq_no'].'%');
            

        }
        if(isset($data['client_id']) && $data['client_id']!=''){
            $bidRfq->where('client_id','like','%'.$data['client_id'].'%');
            

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
       
       
        
        
        $client = Client::get();
        $vendor = Vendor::get();
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
            $unique_no = BidRfq::orderBy('id', 'DESC')->pluck('id')->first();
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
        $bidrfq="";
        $bidrfq=[];
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
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
        for($i=0; $i< count($wonproject);$i++)
        {
            array_push($rfq,$wonproject[$i]['rfq_no']);
        }
        // dd($bidrfq);
        return view('bidrfq.edit',compact('bidrfq','client','vendor','country','id','wonproject','rfq'));
    }
    
    public function update(Request $req)
    {
        // dd($req->all());
        
        // dd($v);
      $v = $req->all();
        
        $response_data = [];
        $validator = Validator::make($req->all(), [ 
            'country_0.*'  => 'required',
            'client_id_0.*' => 'required',
            'methodology_0.*' => 'required',
            "vendor_id_0.*" => "required",
            'setup_cost_0.*' => 'required',
            'recruitment_0.*' => "required",
            'incentives_0.*' => 'required',
            'moderation_0.*' => "required",
            'transcript_0.*' => 'required',
            'others_0.*' => "required",
            'total_cost_0.*' => 'required',
      
     ]);
     if (!$validator->fails()) {
         // dd($req->bidrfqCount);
         for($i=0; $i<$req->bidrfqCount; $i++)
         {
             // dd( implode(',',$req->$a));
             $bidrfq = new BidRfq();
             
             $bidrfq = BidRfq::where('id', $req->id)->first();
             $rfqNo = $req->rfq_no;
             $rfq_no = str_replace('{"rfq_no":"', '', $rfqNo);
                $rfq_no1 = str_replace('"}', '', $rfq_no);
                $rfq1 = explode('_', $rfq_no1);
                $bid = $rfq1[0];
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
                $bidrfq->rfq_no = $bid;
                $bidrfq->client_id =json_encode($req->client_id_0);
                $bidrfq->vendor_id = json_encode($req->vendor_id_0);
                $bidrfq->methodology = json_encode($req->methodology_0);
                $bidrfq->country = json_encode($req->country_0);
                $bidrfq->sample_size = json_encode($req->sample_size_0);
                $bidrfq->setup_cost =json_encode($req->setup_cost_0);
                $bidrfq->recruitment = json_encode($req->recruitment_0);
                $bidrfq->incentives = json_encode($req->incentives_0);
                $bidrfq->moderation  = json_encode($req->moderation_0);
                $bidrfq->transcript = json_encode($req->transcript_0);
                $bidrfq->others = json_encode($req->others_0);
                $bidrfq->total_cost = json_encode($req->total_cost_0);
                $bidrfq->date = $req->date;
                $bidrfq->industry = $req->industry;
                $bidrfq->comments = $req->comments;
                $bidrfq->company_name = $req->company_name;
                $bidrfq->follow_up_date = $req->follow_up_date;
                //  $bidrfq->industry_table = $req->industry_table;
                // $bidrfq->client_id = implode(',',$req->$client_id);
                // $bidrfq->vendor_id = implode(',',$req->$vendor_id);
                // $bidrfq->sample_size = implode(',',$req->$sample_size);
                // $bidrfq->setup_cost = implode(',',$req->$setup_cost);
                // $bidrfq->recruitment = implode(',',$req->$recruitment);
                // $bidrfq->incentives = implode(',',$req->$incentives);
                // $bidrfq->moderation = implode(',',$req->$moderation);
                // $bidrfq->transcript = implode(',',$req->$transcript);
                // $bidrfq->others = implode(',',$req->$others);
                // $bidrfq->country = implode(',',$req->$country);
                // $bidrfq->total_cost = implode(',',$req->$total_cost);
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
                    $response_data = ["success" => 1, "message" => "RfqBid Updated Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
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
                $bidrfq = Bidrfq::where('id', $req->id) 
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
                $bidrfq = Bidrfq::where('id', $req->id) 
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

        $school= BidRfq::where('id',$id)->firstorfail()->delete();

        if($school)
        {
            $response_data = ["success" => 1, "message" => "School Deleted Successfully"];
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
       $bidrfq=Bidrfq::where('type','lost')->latest();
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
        return view('bidrfq.lostprojectlist',compact('bidrfq','client'));
       }
    }
    public function lostProjectView($id){
      
        $wonproject= WonProject::select('rfq_no')->get()->toArray();
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $bidrfq = BidRfq::where('id', $id)->first();
        $rfq = array();
        for($i=0; $i< count($wonproject);$i++)
        {
            array_push($rfq,$wonproject[$i]['rfq_no']);
        }
        return view('bidrfq.lostview',compact('bidrfq','client','vendor','country','id','wonproject','rfq'));
    }
     public function wonupdate(Request $req)
    {
        // dd($req->all());
        
        // dd($v);
      $v = $req->all();
        
        $response_data = [];
        $validator = Validator::make($req->all(), [ 
            'country_0.*'  => 'required',
            'client_id_0.*' => 'required',
            "vendor_id_0.*" => "required",
            'setup_cost_0.*' => 'required',
            'recruitment_0.*' => "required",
            'incentives_0.*' => 'required',
            'moderation_0.*' => "required",
            'transcript_0.*' => 'required',
            'others_0.*' => "required",
            'total_cost_0.*' => 'required',
      
     ]);
    
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
            for($i=0; $i<$req->bidrfqCount; $i++)
            {
                // dd( implode(',',$req->$a));
                $bidrfq = new BidRfq();
                $bidrfq = BidRfq::where('id', $req->id)->first();
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
                $bidrfq->rfq_no = $req->rfq_no;
                $bidrfq->client_id =json_encode($req->client_id_0);
                $bidrfq->vendor_id = json_encode($req->vendor_id_0);
                $bidrfq->country = json_encode($req->country_0);
                $bidrfq->sample_size = json_encode($req->sample_size_0);
                $bidrfq->setup_cost =json_encode($req->setup_cost_0);
                $bidrfq->recruitment = json_encode($req->recruitment_0);
                $bidrfq->incentives = json_encode($req->incentives_0);
                $bidrfq->moderation  = json_encode($req->moderation_0);
                $bidrfq->transcript = json_encode($req->transcript_0);
                $bidrfq->others = json_encode($req->others_0);
                $bidrfq->total_cost = json_encode($req->total_cost_0);
                $bidrfq->date = $req->date;
                $bidrfq->industry = $req->industry;
                $bidrfq->comments = $req->comments;
                $bidrfq->follow_up_date = $req->follow_up_date;
                //  $bidrfq->industry_table = $req->industry_table;
                // $bidrfq->client_id = implode(',',$req->$client_id);
                // $bidrfq->vendor_id = implode(',',$req->$vendor_id);
                // $bidrfq->sample_size = implode(',',$req->$sample_size);
                // $bidrfq->setup_cost = implode(',',$req->$setup_cost);
                // $bidrfq->recruitment = implode(',',$req->$recruitment);
                // $bidrfq->incentives = implode(',',$req->$incentives);
                // $bidrfq->moderation = implode(',',$req->$moderation);
                // $bidrfq->transcript = implode(',',$req->$transcript);
                // $bidrfq->others = implode(',',$req->$others);
                // $bidrfq->country = implode(',',$req->$country);
                // $bidrfq->total_cost = implode(',',$req->$total_cost);
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
                    $response_data = ["success" => 1, "message" => "RfqBid Updated Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            }
        } else {
            $response_data = ["success" => 2, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }
     public function pdfview($id){
        $biddownload=BidRfq::where('id',$id)->first();
        // dd($biddownload);
        return view('bidrfq.pdfbidrfq',compact('biddownload'));
        
    }

    public function downloadpdf($id){
        // dd($id);
        $biddownload=BidRfq::where('id',$id)->first();
        $path = 'assets/images/logo-3.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = PDF::loadView('bidrfq.pdfdownload',compact('biddownload','data','logo'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('pdf_file.pdf');

    }
}
