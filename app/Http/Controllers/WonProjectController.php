<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidRfq;
use App\Models\Country;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\WonProject;
use App\Models\OperationNew;
use App\Models\Notification;
use App\Models\RfqDetailsTable;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use Session;
use Yajra\DataTables\Facades\DataTables;


class WonProjectController extends Controller
{

    public function index(Request $request,WonProject $wonproject)
    {
        
        $data=$request->all();
        
        $user = Auth::user(); // Get authenticated user

        // Base query for fetching WonProject data
        $wonproject = WonProject::latest();
        
        // Apply filtering for sales users
        if ($user->user_type == 'sales') {
            $wonproject->where('user_id', $user->id);
        }
        
        // Execute the query
        $wonproject = $wonproject;
        if(isset($data['rfq_no']) && $data['rfq_no']!=''){
            $wonproject->where('rfq_no','like','%'.$data['rfq_no'].'%');

        }
        if(isset($data['project_execution']) && $data['project_execution']!=''){
            $wonproject->where('project_execution','like','%'.$data['project_execution'].'%');

        }
        if(isset($data['project_start_date1']) && $data['project_start_date2']!=''){
            $wonproject->whereBetween('project_start_date',[$data['project_start_date1'],$data['project_start_date2']]);
        }
        if(isset($data['mode']) && $data['mode']!=''){
            $wonproject->where('mode',[$data['mode'],$data['mode']]);
        }
        
        // $wonproject->orderBy('id','Desc')->get();
         
        $client = Client::get();
        $vendor = Vendor::get();
        $bidRfq =RfqDetailsTable::get();

         
         
        $country = Country::get();

        
          
        
        
        if ($request->ajax()) {

            
           
            return Datatables::of($wonproject->get())
            
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view(' wonproject.index',compact('bidRfq','client','country','vendor', 'wonproject'));
        
    }
    
    //     $user = Auth::user();
        
    //     if($user->user_type=="admin"){
    //         $wonproject = WonProject::latest()->paginate(5);
    //     }else{
    //         $wonproject = WonProject::where('user_id',$user->id)->paginate(5);
    //     }
    //     $bidrfq = BidRfq::get();
    //     // dd($bidrfq);
       
    //     return view('wonproject.index', compact('wonproject','bidrfq'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function createwon(Bidrfq $bidrfq)
    {
        // dd('hi');
         $wonproject="";
         $bidrfq = BidRfq::get();
         $country = Country::get();
         $client = Client::get();
         $vendor = Vendor::get();
        return view('wonproject.createwonpro',compact('wonproject','bidrfq','country','client','vendor'));
    }
    public function change(Request $req,BidRfq $bidrfq)
    {
        
        $wonproject="";
        $country = Country::get();
        $client = Client::get();
        $vendor = Vendor::get();
        $bidrfq = BidRfq::get();
        $sample_size = BidRfq::where('sample_size')->get();
        
      
        
       $arr=[];
       $world=[];
        foreach ($bidrfq as $p) {
            $world=explode(",",$p->country);
            $client_id=explode(",",$p->sample_size);
            $sample_size=explode(",",$p->sample_size);
        }
        

        
       
        
       
       
         return view('wonproject.create',['sample_size'=>$sample_size,'world'=>$world],compact('wonproject','bidrfq','country','client','vendor'));
    }

    public function view(Request $req){
        $client=Client::select('client_name')->get();
        $vendor=Vendor::select('vendor_name')->get();
        $country = Country::get();
        $bidrfq=BidRfq::where('rfq_no',$req->id)->first();
        if($bidrfq){
            $response_data=["success"=> 1 ,"message"=>"successfully" ,"bidrfq"=>$bidrfq,"country"=>$country,"client"=>$client,"vendor"=>$vendor];
            
        }
        else{
            $response_data=["success"=>0, "message"=>"server side error","bidrfq"=>""];
        }
        return response()->json($response_data);
    }

    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
    public function store(Request $req)
    {
      
        $v = $req->all();
         //ssdd($v);
    
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        $user = Auth::user();
        if (!$validator->fails()) {
            $data=[];
            // $client_array_1=[];
        
           
            for($i=0; $i<$req->wonCount; $i++)
            {
                $vendor_advance='vendor_advance_'.$i;
                $vendor_balance='vendor_balance_'.$i;
                $vendor_contract ='vendor_contract_'.$i;
               
            $wonproject = new WonProject();

            $wonproject->user_id = $user->id;
            $rfq=explode('_',$req->rfq_no);
            $rfq1=$rfq[0];
            $client_id=$rfq[1];
            $wonproject->rfq=$rfq1;
            $wonproject->rfq_no =$req->rfq_no;
            $wonproject->client_id =$client_id;
            $wonproject->project_name=$req->project_name;
            $wonproject->project_type =$req->project_type;
            $wonproject->project_execution = $req->project_execution;       
            $wonproject->currency=$req->currency;
            $wonproject->mode=$req->mode;
            $wonproject->project_start_date = $req->project_start_date;
            $wonproject->project_end_date = $req->project_end_date;
            $wonproject->client_total =  $req->client_total;       
            $wonproject->client_advance = $req->client_advance;
            $wonproject->client_balance =  $req->client_balance;
            $wonproject->vendor_id=implode(',',$req->vendor_id_0);
            $wonproject->vendor_total = implode(',',$req->vendor_total_0); 
            $wonproject->vendor_advance =  implode(',',$req->vendor_advance_0);
            $wonproject->vendor_balance =  implode(',',$req->vendor_balance_0);
            $wonproject->total_margin =  $req->total_margin;
            $wonproject->sales_comment =  $req->sales_comment;

              if ($req->has('client_contract'))
            {
                $file = $req->file('client_contract');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/client_contract', $filename);
                $wonproject->client_contract = 'global_assets/client_contract/' . $filename;
            }
          
            if ($req->hasfile('vendor_contract_0')) {
                foreach ($req->file('vendor_contract_0') as $key=> $image) {
                    $file= $image;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    
                    $file->move('global_assets/vendor_contract', $filename);
                    $data[] = ('global_assets/vendor_contract/' . $filename);
                    $wonproject->vendor_contract = implode(',',$data);
                }
            }
            // $rfq = BidRfq::where('rfq_no',$rfq1)->first();
            // if($rfq)
            // {
            //     $rfq->type = 'next';
            //     $rfq->save();
            // } 
            
            // dd($wonproject);
            if ($wonproject->save()) {
                $rfqwon = WonProject::where('rfq',$rfq1)->count();
                $rfqstatus = RfqDetailsTable::where('rfq_no',$rfq1)->first();
                $rfq = RfqDetailsTable::with([
                  'single' => function ($query) {
                      $query->select('rfq_details_id', 'single_client');
                  },
                  'multiple' => function ($query) {
                      $query->select('rfq_details_id', 'multiple_client');
                  },
                  'interview' => function ($query) {
                      $query->select('rfq_details_id', 'interview_depth_client');
                  },
                  'online' => function ($query) {
                      $query->select('rfq_details_id', 'online_community_client');
                  }
              ])->where('rfq_no', $rfq1)->first();
              
              $clients = [];
              
              // Collect client names from each related table
              if ($rfq) {
                  if ($rfq->single && $rfq->single->single_client) {
                      $clients[] = $rfq->single->single_client;
                  }
                  if ($rfq->multiple && $rfq->multiple->multiple_client) {
                      $clients[] = $rfq->multiple->multiple_client;
                  }
                  if ($rfq->interview && $rfq->interview->interview_depth_client) {
                      $clients[] = $rfq->interview->interview_depth_client;
                  }
                  if ($rfq->online && $rfq->online->online_community_client) {
                      $clients[] = $rfq->online->online_community_client;
                  }
              }
              
              $rfq1 = json_encode($clients); // Convert array to JSON if needed
              $rfq2 = count($clients); // Get the count of clients
               if($rfq2 == $rfqwon)
               {
                $rfqstatus->type = 'won';
                $rfqstatus->save();
                  $response_data = ["success" => 1, "message" => "won Successfully"];
               } 
               else{
                $response_data = ["success" => 0, "message" => "not won"];
               }
                $wonnotification=new Notification();
                $wonnotification->status='0';
                $wonnotification->type='won';
                $wonnotification->rfq_no=$req->rfq_no;
                if($wonnotification->save()){
                    $response_data = ["success" => 1, "message" => "RfqBid Created Successfully"];
                }
                else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
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
    
    public function edit($id)
    {

        // $bidrfq = BidRfq ::get();
        $vendor1=Vendor::get();
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $wonproject = WonProject::where('id', $id)->first();
        $rfq= WonProject::where('id', $id)->select('rfq_no')->first();
        $rfq_no=str_replace('{"rfq_no":"','', $rfq);
        $rfq_no1=str_replace('"}','',$rfq_no);
        $rfq1=explode('_',$rfq_no1);
        $bid=$rfq1[0];
        $bidrfq = BidRfq::where('rfq_no', $bid)->first();
         $newrfq = RfqDetailsTable::with('single','multiple','interview','online')->where('rfq_no', $bid)->first();
        //dd($newrfq);
        
        return view('wonproject.edit', compact('wonproject','bidrfq','newrfq','vendor1','client','vendor','country'));
       }
    

    public function update(Request $req)
    {
        $v = $req->all();
        //dd($v);
    
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        $user = Auth::user();
        if (!$validator->fails()) {
            $data=[];
            // $client_array_1=[];
            
            
            //dd($data);
            for($i=0; $i<$req->wonCount; $i++)
            { 
                // dd($vendor_array_1);
                $wonproject = WonProject::where('id', $req->id)->first();
            // $wonproject->user_id = $user->id;
            $rfq=explode('_',$req->rfq_no);
            $rfq1=$rfq[0];
            $client_id=$rfq[1];
            $wonproject->rfq_no =$req->rfq_no;
            $wonproject->client_id =$client_id;
            $wonproject->project_name=$req->project_name;
            $wonproject->project_type =$req->project_type;
            $wonproject->project_execution = $req->project_execution;       
            $wonproject->currency=$req->currency;
            $wonproject->mode=$req->mode;
            $wonproject->project_start_date = $req->project_start_date;
            $wonproject->project_end_date = $req->project_end_date;
            $wonproject->client_total =  $req->client_total;       
            $wonproject->client_advance = $req->client_advance;
            $wonproject->client_balance =  $req->client_balance;
            $wonproject->vendor_id=implode(',',$req->vendor_id_0);
            $wonproject->vendor_total = implode(',',$req->vendor_total_0); 
            $wonproject->vendor_advance =  implode(',',$req->vendor_advance_0);
            $wonproject->vendor_balance =  implode(',',$req->vendor_balance_0);
            $wonproject->total_margin =  $req->total_margin;
            $wonproject->sales_comment =  $req->sales_comment;

              if ($req->has('client_contract'))
            {
                $file = $req->file('client_contract');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/client_contract', $filename);
                $wonproject->client_contract = 'global_assets/client_contract/' . $filename;
            }
          
            if ($req->hasfile('vendor_contract_0')) {
                foreach ($req->file('vendor_contract_0') as $key=> $image) {
                    $file= $image;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    
                    $file->move('global_assets/vendor_contract', $filename);
                    $data[] = ('global_assets/vendor_contract/' . $filename);
                    $wonproject->vendor_contract = implode(',',$data);
                }
            } 
            if ($wonproject->save()) {
                $response_data = ["success" => 1, "message" => "WonProject Updated Successfully"];
                
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
           }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }
    public function delete(Request $req,$id)
    {
       // $id=$req->data;
    
        $school= WonProject::where('id',$id)->delete();
    
        if($school)
        {
            $response_data = ["success" => 1, "message" => "Client Deleted Successfully"];
            return redirect()->route('wonproject.index');
    
        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }
    
        return response()->json($response_data);
    }
      public function viewsalesfigures(Request $request)
    {
        $user = WonProject::get(); 
        $authUser = Auth::user();
        $clientQuery = WonProject::select('rfq_no');
        
        if ($authUser->user_type == 'sales') {
            $clientQuery->where('user_id', $authUser->id);
        }
        $client = $clientQuery->get();
        $wonproject="";
        $client_total="0";
        $vendor_toatl="0";
        $wonproject_total=array();
        $bidrfq = BidRfq::get();
        $viewsalesfigures = new WonProject();
        // dd($client);
        return view('wonproject.viewsalesfigures', compact('viewsalesfigures','wonproject','wonproject_total','client_total','vendor_toatl','client'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function viewsalesfigures_filter(Request $request)
    {
        $wonproject = WonProject::where('project_start_date','>=',$request->from)->where('project_start_date','<=',$request->to)->sum('total_margin');
        return response()->json($wonproject);
    }
    public function viewsalesfigures_filter_invoice(Request $request)
    { 
        // $authUser = Auth::user();
        // dd($request->all());
      if($request->client_id && $request->start && $request->start){
      $wonproject_total = WonProject::selectraw("SUM(client_total) as client_total,SUM(total_margin) as total_margin")->where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('rfq_no','=',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->first()->toArray();
      $vendor_total1=WonProject::where('rfq_no',$request->client_id)->where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->select('vendor_total')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->first();
      $vendor_total1=str_replace('{"vendor_total":"','', $vendor_total1);
      $vendor_total1=str_replace('"}','', $vendor_total1);
      $vendor=explode(',',$vendor_total1);
      $vendor1=array_sum($vendor);
      
    //   client advance and balance
    //   $client_advance_usd=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->sum('client_advance');
    //   $client_balance_usd=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->sum('client_advance');
    //   $client_advance_inr=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->sum('client_advance');
    //   $client_balance_inr=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->sum('client_advance');
    //   $client_advance_euro=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->sum('client_advance');
    //   $client_balance_euro=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->sum('client_advance');
    //   $client_advance_pound=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','£')->sum('client_advance');
    //   $client_balance_pound=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','£')->sum('client_advance');
    //   $client_usd= intval($client_advance_usd+ $client_balance_usd);
    //   $client_inr= intval($client_advance_inr+ $client_balance_inr);
    //   $client_euro= intval($client_advance_euro+ $client_balance_euro);
    //   $client_pound= intval($client_advance_pound+ $client_balance_pound);
    
    
      $client_usd=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
      $client_inr=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
      $client_euro=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');;
      $client_pound=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','£')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
    
    
      
      $vendor_advance_usd1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
     
      $vendor_sum1 = 0 ;
             for($i=0;$i<count($vendor_advance_usd1);$i++)
             {
             $vendor_revenue=explode(',',$vendor_advance_usd1[$i]['vendor_total']);
             $vendor_sum1 = $vendor_sum1 + array_sum($vendor_revenue);
              }
              
              
         $vendor_usd=$vendor_sum1;
         
              
    //   $vendor_advance_usd=$vendor_sum1;
    
  
     
      
      
    //   $vendor_balance_usd1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->where('rfq_no',$request->client_id)->select('vendor_balance')->get();
    //   $vendor_sum2 = 0 ;
    //          for($i=0;$i<count($vendor_advance_usd1);$i++)
    //          {
    //          $vendor_revenue1=explode(',',$vendor_balance_usd1[$i]['vendor_balance']);
    //          $vendor_sum2 = $vendor_sum2 + array_sum($vendor_revenue1);
    //           }
    //   $vendor_balance_usd=$vendor_sum2;
      
      
      
   
      $vendor_advance_inr1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
    
     
      $vendor_sum3 = 0 ;
             for($i=0;$i<count($vendor_advance_inr1);$i++)
             {
             $vendor_revenue2=explode(',',$vendor_advance_inr1[$i]['vendor_total']);
             $vendor_sum3 = $vendor_sum3 + array_sum($vendor_revenue2);
              }
              
         $vendor_inr=$vendor_sum3;
         
    //   $vendor_advance_inr=$vendor_sum3;
     
      
    //   $vendor_balance_inr1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->where('rfq_no',$request->client_id)->select('vendor_balance')->get();
    //   $vendor_sum4 = 0 ;
    //          for($i=0;$i<count($vendor_balance_inr1);$i++)
    //          {
    //          $vendor_revenue3=explode(',',$vendor_balance_inr1[$i]['vendor_balance']);
    //          $vendor_sum4 = $vendor_sum4 + array_sum($vendor_revenue3);
    //          }
              
    //   $vendor_balance_inr=$vendor_sum4;
      
      
      
      $vendor_advance_euro1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
      
       $vendor_sum5 = 0 ;
             for($i=0;$i<count($vendor_advance_euro1);$i++)
             {
             $vendor_revenue4=explode(',',$vendor_advance_euro1[$i]['vendor_total']);
             $vendor_sum5 = $vendor_sum5 + array_sum($vendor_revenue4);
             }
              
              
         $vendor_euro=$vendor_sum5;    
    //   $vendor_advance_euro=$vendor_sum5;
     
      
      
      
    //   $vendor_balance_euro1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->where('rfq_no',$request->client_id)->select('vendor_balance')->get();
    //   $vendor_sum6 = 0 ;
    //          for($i=0;$i<count($vendor_advance_euro1);$i++)
    //          {
    //          $vendor_revenue5=explode(',',$vendor_balance_euro1[$i]['vendor_balance']);
    //          $vendor_sum6 = $vendor_sum6 + array_sum($vendor_revenue5);
    //          }
              
    //   $vendor_balance_euro=$vendor_sum6;
      
      
      
      
      
      $vendor_advance_pound1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('rfq_no',$request->client_id)->where('currency','£')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
      $vendor_sum7 = 0 ;
             for($i=0;$i<count($vendor_advance_pound1);$i++)
             {
             $vendor_revenue6=explode(',',$vendor_advance_pound1[$i]['vendor_total']);
             $vendor_sum7 = $vendor_sum7 + array_sum($vendor_revenue6);
              }
           
      $vendor_pound=$vendor_sum7;   
    //   $vendor_advance_pound=$vendor_sum7;
     
     
      
    //   $vendor_balance_pound1=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('rfq_no',$request->client_id)->where('currency','£')->select('vendor_balance')->get();
    //   $vendor_sum8 = 0 ;
    //          for($i=0;$i<count($vendor_balance_pound1);$i++)
    //          {
    //          $vendor_revenue7=explode(',',$vendor_balance_pound1[$i]['vendor_balance']);
    //          $vendor_sum8 = $vendor_sum8 + array_sum($vendor_revenue7);
    //           }
              
    //   $vendor_balance_pound=$vendor_sum8;
     
      
    //   $vendor_usd= intval($vendor_advance_usd+ $vendor_balance_usd);
    //   $vendor_inr= intval($vendor_advance_inr+ $vendor_balance_inr);
    //   $vendor_euro= intval($vendor_advance_euro+ $vendor_balance_euro);
    //   $vendor_pound= intval($vendor_advance_pound+ $vendor_balance_pound);
    
      $total_usd=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','$')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_inr=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','₹')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_euro=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','€')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_pound=Wonproject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('currency','£')->where('rfq_no',$request->client_id)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      
      
      $total_usd1= intval($total_usd);
      $total_inr1= intval($total_inr);
      $total_euro1= intval($total_euro);
      $total_pound1= intval($total_pound);
            }
        else{
          
      $vendor_total1=WonProject::select('vendor_total','rfq_no')->where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->get();
      $vendor_total1=str_replace('{"vendor_total":"','', $vendor_total1);
      $vendor_total1=str_replace('"}','', $vendor_total1);
      $vendor=explode(',',$vendor_total1);
      $vendor1=array_sum($vendor);
      
       $wonproject_total = WonProject::selectraw("SUM(client_total) as client_total,SUM(total_margin) as total_margin")->where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->first()->toArray();
       
      $client_usd=Wonproject::where('created_at','<=',$request->end)->where('currency','$')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
    
      $client_inr=Wonproject::where('created_at','<=',$request->end)->where('currency','₹')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
     
      $client_euro=Wonproject::where('created_at','<=',$request->end)->where('currency','€')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
   
      $client_pound=Wonproject::where('created_at','<=',$request->end)->where('currency','£')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('client_total');
 
    //   $client_advance_usd=Wonproject::where('created_at','<=',$request->end)->where('currency','$')->sum('client_advance');
    //   $client_balance_usd=Wonproject::where('created_at','<=',$request->end)->where('currency','$')->sum('client_balance');
    //   $client_advance_inr=Wonproject::where('created_at','<=',$request->end)->where('currency','₹')->sum('client_advance');
    //   $client_balance_inr=Wonproject::where('created_at','<=',$request->end)->where('currency','₹')->sum('client_balance');
    //   $client_advance_euro=Wonproject::where('created_at','<=',$request->end)->where('currency','€')->sum('client_advance');
    //   $client_balance_euro=Wonproject::where('created_at','<=',$request->end)->where('currency','€')->sum('client_balance');
    //   $client_advance_pound=Wonproject::where('created_at','<=',$request->end)->where('currency','£')->sum('client_advance');
    //   $client_balance_pound=Wonproject::where('created_at','<=',$request->end)->where('currency','£')->sum('client_balance');
    //   $wonproject_total = WonProject::selectraw("SUM(client_total) as client_total,SUM(total_margin) as total_margin")->where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->first()->toArray();
    //   $client_usd= intval($client_advance_usd+ $client_balance_usd);
    //   $client_inr= intval($client_advance_inr+ $client_balance_inr);
    //   $client_euro= intval($client_advance_euro+ $client_balance_euro);
    //   $client_pound= intval($client_advance_pound+ $client_balance_pound);
      
      
    //   $vendor_advance_usd=Wonproject::where('project_start_date','<=',$request->end)->where('currency','$')->sum('vendor_advance');
    //   $vendor_balance_usd=Wonproject::where('project_start_date','<=',$request->end)->where('currency','$')->sum('vendor_balance');
    //   $vendor_advance_inr=Wonproject::where('project_start_date','<=',$request->end)->where('currency','₹')->sum('vendor_advance');
    //   $vendor_balance_inr=Wonproject::where('project_start_date','<=',$request->end)->where('currency','₹')->sum('vendor_balance');
    //   $vendor_advance_euro=Wonproject::where('project_start_date','<=',$request->end)->where('currency','€')->sum('vendor_advance');
    //   $vendor_balance_euro=Wonproject::where('project_start_date','<=',$request->end)->where('currency','€')->sum('vendor_balance');
    //   $vendor_advance_pound=Wonproject::where('project_start_date','<=',$request->end)->where('currency','£')->sum('vendor_advance');
    //   $vendor_balance_pound=Wonproject::where('project_start_date','<=',$request->end)->where('currency','£')->sum('vendor_balance');
    
     $vendor_advance_usd1=Wonproject::where('created_at','<=',$request->end)->where('currency','$')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
      $vendor_sum1 = 0 ;
             for($i=0;$i<count($vendor_advance_usd1);$i++)
             {
             $vendor_revenue=explode(',',$vendor_advance_usd1[$i]['vendor_total']);
             $vendor_sum1 = $vendor_sum1 + array_sum($vendor_revenue);
              }
           
         $vendor_usd=$vendor_sum1;   
         
    //   $vendor_advance_usd=$vendor_sum1;
    
  
     
      
      
    //   $vendor_balance_usd1=Wonproject::where('project_start_date','<=',$request->end)->where('currency','$')->select('vendor_balance')->get();
    //   $vendor_sum2 = 0 ;
    //          for($i=0;$i<count($vendor_advance_usd1);$i++)
    //          {
    //          $vendor_revenue1=explode(',',$vendor_balance_usd1[$i]['vendor_balance']);
    //          $vendor_sum2 = $vendor_sum2 + array_sum($vendor_revenue1);
    //           }
    //   $vendor_balance_usd=$vendor_sum2;
      
      
      
   
      $vendor_advance_inr1=Wonproject::where('created_at','<=',$request->end)->where('currency','₹')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
    
     
      $vendor_sum3 = 0 ;
             for($i=0;$i<count($vendor_advance_inr1);$i++)
             {
             $vendor_revenue2=explode(',',$vendor_advance_inr1[$i]['vendor_total']);
             $vendor_sum3 = $vendor_sum3 + array_sum($vendor_revenue2);
              }
              
         $vendor_inr=$vendor_sum3;
              
    //   $vendor_advance_inr=$vendor_sum3;
     
      
    //   $vendor_balance_inr1=Wonproject::where('project_start_date','<=',$request->end)->where('currency','₹')->select('vendor_balance')->get();
    //   $vendor_sum4 = 0 ;
    //          for($i=0;$i<count($vendor_balance_inr1);$i++)
    //          {
    //          $vendor_revenue3=explode(',',$vendor_balance_inr1[$i]['vendor_balance']);
    //          $vendor_sum4 = $vendor_sum4 + array_sum($vendor_revenue3);
    //          }
              
    //   $vendor_balance_inr=$vendor_sum4;
      
      
      
      $vendor_advance_euro1=Wonproject::where('created_at','<=',$request->end)->where('currency','€')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
      
       $vendor_sum5 = 0 ;
             for($i=0;$i<count($vendor_advance_euro1);$i++)
             {
             $vendor_revenue4=explode(',',$vendor_advance_euro1[$i]['vendor_total']);
             $vendor_sum5 = $vendor_sum5 + array_sum($vendor_revenue4);
             }
             
         $vendor_euro=$vendor_sum5;
              
    //   $vendor_advance_euro=$vendor_sum5;
     
      
      
      
    //   $vendor_balance_euro1=Wonproject::where('project_start_date','<=',$request->end)->where('currency','€')->select('vendor_balance')->get();
    //   $vendor_sum6 = 0 ;
    //          for($i=0;$i<count($vendor_advance_euro1);$i++)
    //          {
    //          $vendor_revenue5=explode(',',$vendor_balance_euro1[$i]['vendor_balance']);
    //          $vendor_sum6 = $vendor_sum6 + array_sum($vendor_revenue5);
    //          }
              
    //   $vendor_balance_euro=$vendor_sum6;
      
      
      
      
      
      $vendor_advance_pound1=Wonproject::where('created_at','<=',$request->end)->where('currency','£')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->select('vendor_total')->get();
      $vendor_sum7 = 0 ;
             for($i=0;$i<count($vendor_advance_pound1);$i++)
             {
             $vendor_revenue6=explode(',',$vendor_advance_pound1[$i]['vendor_total']);
             $vendor_sum7 = $vendor_sum7 + array_sum($vendor_revenue6);
              }
              
      $vendor_pound=$vendor_sum7;
    //   $vendor_advance_pound=$vendor_sum7;
     
     
      
    //   $vendor_balance_pound1=Wonproject::where('project_start_date','<=',$request->end)->where('currency','£')->select('vendor_balance')->get();
    //   $vendor_sum8 = 0 ;
    //          for($i=0;$i<count($vendor_balance_pound1);$i++)
    //          {
    //          $vendor_revenue7=explode(',',$vendor_balance_pound1[$i]['vendor_balance']);
    //          $vendor_sum8 = $vendor_sum8 + array_sum($vendor_revenue7);
    //           }
              
    //   $vendor_balance_pound=$vendor_sum8;
     
    //   $vendor_usd= intval($vendor_advance_usd+ $vendor_balance_usd);
    //   $vendor_inr= intval($vendor_advance_inr+ $vendor_balance_inr);
    //   $vendor_euro= intval($vendor_advance_euro+ $vendor_balance_euro);
    //   $vendor_pound= intval($vendor_advance_pound+ $vendor_balance_pound);
     
      
      
      $total_usd=Wonproject::where('created_at','<=',$request->end)->where('currency','$')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_inr=Wonproject::where('created_at','<=',$request->end)->where('currency','₹')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_euro=Wonproject::where('created_at','<=',$request->end)->where('currency','€')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      $total_pound=Wonproject::where('created_at','<=',$request->end)->where('currency','£')->when(auth()->user()->user_type == 'sales', function($query){
        $query->where('user_id', auth()->user()->id);
      })->sum('total_margin');
      
      $total_usd1= intval($total_usd);
      $total_inr1= intval($total_inr);
      $total_euro1= intval($total_euro);
      $total_pound1= intval($total_pound);
      
      
     
      
     
      
      }
        
        $client_total=$wonproject_total['client_total'];
        $vendor_total=$vendor1;
        $total_margin=$wonproject_total['total_margin'];
        
        
        if(!$client_total) {
            $client_total = 0;
           }
        if(!$vendor_total) {
            $vendor_total = 0;
           }
        if(!$total_margin) {
            $total_margin = 0;
           }
        return response()->json([
            'client_total' => $client_total,
            'vendor_total' => $vendor_total,
            'total_margin' =>$total_margin,
            'client_usd'=>$client_usd,
            'client_inr'=>$client_inr,
            'client_euro'=>$client_euro,
            'client_pound'=>$client_pound,
            'vendor_usd'=>$vendor_usd,
            'vendor_inr'=>$vendor_inr,
            'vendor_euro'=>$client_euro,
            'vendor_pound'=>$vendor_pound,
            'total_usd'=>$total_usd1,
            'total_inr'=>$total_inr1,
            'total_euro'=>$total_euro1,
            'total_pound'=>$total_pound1,
        ]);
    
    }
    public function Overview(){
        return view('wonproject.overview');
    }

    public function downloadData(Request $request){
         
        //  dd($request->all());
        if($request->client_id !=''){
            
        $down_data = WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('rfq_no','=',$request->client_id)->get(['client_id','rfq_no','total_margin','client_total','vendor_total','currency'])->toArray();
        
        // $down_data1 = WonProject::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('rfq_no','=',$request->client_id)->get(['vendor_total'])->toArray();
        // dd($down_data);
        // $sum1= 0;
        //  for($i=0;$i<count($down_data);$i++){
        //     $vendor=explode(',',$down_data[$i]['vendor_total']);
        //     // dd($vendor);
        //      $sum1 = $sum1 + array_sum($vendor);
           
        //     //  dd($sum1);
              
        // }   
        // $vendor1=$sum1;
        // // dd($vendor1);
       
        
        
        }
        else if($request->start !='' && $request->end  !='' ) {
            
            $down_data = WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->get(['client_id','rfq_no','total_margin','vendor_total','client_total','currency'])->toArray();
            // dd($down_data);
        }
        else{
            $down_data = WonProject::get(['client_id','rfq_no','total_margin','vendor_total','client_total','currency'])->toArray();
        }
        return response()->json(["down_data"=>$down_data]);
    }
    
    public function prostatus($id){
        $operation=OperationNew::where('rfq',$id)->first();
        $country=Country::get();
        return view('wonproject.operationstatus',compact('operation','country'));
    }
    public function getstatus(Request $req){
        $wonproject=Wonproject::where('id',$req->id)->first();
        $operation=OperationNew::where('rfq',$wonproject->rfq_no)->first();
        if(!$operation){
            $response_data=["success"=>0,"message"=>"fail"]; 
        }
        else{
            $response_data=["success"=>1,"message"=>"success","rfq"=>$wonproject->rfq_no ];
        }
        return response()->json($response_data);
    }
     public function getuser(){
        $user_name=User::where('user_type','sales')->get();
        $all1=User::where('user_type','sales')->select('id')->get()->toArray();
        $all=array();
               for($i=0; $i<count($all1); $i++){
                  array_push($all,$all1[$i]['id']); 
               }
        $all2=(implode(',', $all));
        // dd($all);
        return view('wonproject.perfomance',compact('user_name','all2'));
    }
    public function salesperfomance(Request $request){
      if($request->id){
        if(is_numeric($request->id)){
            $client=Client::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('user_id',$request->id)->count();
            $total_vendor=Vendor::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('user_id',$request->id)->count();
            $rfq=Bidrfq::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('user_id',$request->id)->count();
            $rfq_follow=Bidrfq::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('type','next')->where('user_id',$request->id)->count();
            $vendor_total1=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('user_id',$request->id)->select('vendor_total')->get();
            $vendor_total1=str_replace('{"vendor_total":"','', $vendor_total1);
            $vendor_total1=str_replace('"}','', $vendor_total1);
            $vendor=explode(',',$vendor_total1);
            $vendor_final= preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '', $vendor);
            $vendor1=array_sum($vendor_final);
            $total_margin=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('user_id',$request->id)->sum('total_margin');
            $client_invoice=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('user_id',$request->id)->sum('client_total');
        }
        else{
        //   dd($request->id);
       $all=$request->id;
       $id=explode(",",$all);
       $client=Client::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->whereIn('user_id',$id)->count();
       $total_vendor=Vendor::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->whereIn('user_id',$id)->count();
       $rfq=Bidrfq::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->whereIn('user_id',$id)->count();
       $rfq_follow=Bidrfq::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->where('type','next')->whereIn('user_id',$id)->count();
       $vendor_total1=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->whereIn('user_id',$id)->select('vendor_total')->get();
       $vendor_total1=str_replace('{"vendor_total":"','', $vendor_total1);
       $vendor_total1=str_replace('"}','', $vendor_total1);
       $vendor=explode(',',$vendor_total1);
       $vendor_final= preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '', $vendor);
       $vendor1=array_sum($vendor_final);
       $total_margin=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->whereIn('user_id',$id)->sum('total_margin');
       $client_invoice=WonProject::where('created_at','>=',$request->start)->where('created_at','<=',$request->end)->whereIn('user_id',$id)->sum('client_total');
        }
       }
       else{
           
       }
       if((!$client) && (!$vendor) && (!$rfq) && (!$vendor1)){
        $response_data=["success"=>0,"message"=>"fail"]; 
       }
       else{
           $response_data=["success"=>1,"message"=>"success","client"=>$client,"total_vendor"=>$total_vendor,"rfq"=>$rfq,"vendor_invoice"=>$vendor1,"total_margin"=>$total_margin,"client_invoice"=>$client_invoice,"rfq_follow"=>$rfq_follow];
       }
       return response()->json($response_data);
    }

    public function completed(Request $request)
    {
        // Get all request data
        $data = $request->all();
    
        // Base query: Fetch only 'completed' projects
       

        $user = Auth::user(); // Get authenticated user
        
        // Base query for fetching completed OperationNew records
        $wonproject = OperationNew::where('status', 'completed');
        
        // Apply filtering for sales users
        if ($user->user_type == 'sales') {
            $wonproject->where('user_id', $user->id);
        }
        
        // Execute the query
        $wonproject = $wonproject;
    
        // Apply filters
        if (isset($data['rfq']) && !empty($data['rfq'])) {
            $wonproject->where('rfq', 'like', '%' . $data['rfq'] . '%');
        }
    
        // if (isset($data['project_execution']) && !empty($data['project_execution'])) {
        //     $wonproject->where('project_execution', 'like', '%' . $data['project_execution'] . '%');
        // }
    
        // if (isset($data['project_start_date1']) && isset($data['project_start_date2']) &&
        //     !empty($data['project_start_date1']) && !empty($data['project_start_date2'])) {
        //     $wonproject->whereBetween('project_start_date', [$data['project_start_date1'], $data['project_start_date2']]);
        // }
    
        // if (isset($data['project_end_date1']) && isset($data['project_end_date2']) &&
        //     !empty($data['project_end_date1']) && !empty($data['project_end_date2'])) {
        //     $wonproject->whereBetween('project_end_date', [$data['project_end_date1'], $data['project_end_date2']]);
        // }
    
        // if (isset($data['mode']) && !empty($data['mode'])) {
        //     $wonproject->where('mode', $data['mode']);
        // }
    
        // Fetch additional required data for the view (if needed)
        $client = Client::get();
        $vendor = Vendor::get();
        $bidRfq = BidRfq::get();
        $country = Country::get();
    
        // Check if request is AJAX for DataTables
        if ($request->ajax()) {
            // Return the data for DataTables
            return Datatables::of($wonproject->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = url("/wonproject/delete/" . $row->id);
                    return '
                        <a href="' . $deleteUrl . '" class="mdi mdi-delete"></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Return the view for non-AJAX requests
        return view('wonproject.completed', compact('bidRfq', 'client', 'country', 'vendor', 'wonproject'));
    }
    
    
    
}

