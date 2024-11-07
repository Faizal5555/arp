<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidRfq;
use App\Models\Country;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\WonProject;
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
        
        $wonproject=WonProject::latest();
        if(isset($data['rfq_no']) && $data['rfq_no']!=''){
            $wonproject->where('rfq_no','like','%'.$data['rfq_no'].'%');

        }
        if(isset($data['project_execution']) && $data['project_execution']!=''){
            $wonproject->where('project_execution','like','%'.$data['project_execution'].'%');

        }
        if(isset($data['project_start_date']) && $data['project_start_date']!=''){
            $wonproject->where('project_start_date','like','%'.$data['project_start_date'].'%');
        }
        if(isset($data['project_end_date']) && $data['project_end_date']!=''){
            $wonproject->where('project_end_date','like','%'.$data['project_end_date'].'%');
        }
        $wonproject->orderBy('id','Desc')->get();
         
        $client = Client::get();
        $vendor = Vendor::get();
        $bidRfq =BidRfq::get();

         
         
        $country = Country::get();

        
          
        
        
        if ($request->ajax()) {

            
           
            return Datatables::of( $wonproject)
            
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
        
        $validator = Validator::make(
            $v,
            []
        );
        $user = Auth::user();
        // dd($user->id);
        
        //  dd($req->rfq_no);
        $str=($req->rfq_no);
        $pieces = explode("_", $str);
        $rfq=$pieces[0];
        $client_id=$pieces[1];

        
        if (!$validator->fails()) {
            $wonproject = new WonProject();
            $wonproject->rfq_no = $req->rfq_no;
            $wonproject->user_id = $user->id;
            $wonproject->client_id = $client_id;
            $wonproject->project_name = $req->project_name;
            $wonproject->project_type = $req->project_type;
            $wonproject->project_execution = $req->project_execution;
            $wonproject->currency = $req->currency;
            $wonproject->project_start_date = $req->project_start_date;
            $wonproject->project_end_date = $req->project_end_date;
            $wonproject->client_total = $req->client_total;
            $wonproject->vendor_total = $req->vendor_total;
            $wonproject->client_advance = $req->client_advance;
            $wonproject->client_balance = $req->client_balance;
            $wonproject->vendor_advance = $req->vendor_advance;
            $wonproject->vendor_balance = $req->vendor_balance;
            $wonproject->total_margin = $req->total_margin;
           
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
            $rfq = BidRfq::where('rfq_no',$req->rfq_no)->first();
            if($rfq)
            {
                $rfq->type = 'won';
                $rfq->save();
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
    
    public function edit($id)
    {

        $bidrfq = BidRfq ::get();
        $wonproject = WonProject::where('id', $id)->first();
    
        return view('wonproject.edit', compact('wonproject','bidrfq'));
    }
    
    public function update(Request $req)
    {
        $v = $req->all();
    
        
    
        $validator = Validator::make(
            $v,
            []
        );
    
        if (!$validator->fails()) {
            $wonproject = WonProject::where('id', $req->id)->first();
            $wonproject->rfq_no = $req->rfq_no;
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
            // $wonproject->client_contract = $req->file('client_contract');
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
                $response_data = ["success" => 1, "message" => "RfqBid Updated Successfully"];

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
        $client=Wonproject::select('rfq_no')->get();
        $wonproject="";
        $client_total="0";
        $vendor_toatl="0";
        $wonproject_total=array();
        $bidrfq = BidRfq::get();
        $viewsalesfigures = new WonProject();
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
        if($request->client_id !=''){
            $wonproject_total = WonProject::selectraw("SUM(client_total) as client_total,SUM(vendor_total) as vendor_total,SUM(total_margin) as total_margin")->where('project_start_date','>=',$request->start)->where('project_start_date','<=',$request->end)->where('rfq_no','=',$request->client_id)->first()->toArray();
            }
        else
        $wonproject_total = WonProject::selectraw("SUM(client_total) as client_total,SUM(vendor_total) as vendor_total,SUM(total_margin) as total_margin")->where('project_start_date','>=',$request->start)->where('project_start_date','<=',$request->end)->first()->toArray();
        
        
        $client_total=$wonproject_total['client_total'];
        $vendor_total=$wonproject_total['vendor_total'];
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
        ]);
    
    }
    public function Overview(){
        return view('wonproject.overview');
    }

    public function downloadData(Request $request){
        if($request->client_id !=''){
        $down_data = WonProject::where('project_start_date','>=',$request->start)->where('project_start_date','<=',$request->end)->where('rfq_no','=',$request->client_id)->get(['client_id','rfq_no','total_margin','vendor_total','client_total'])->toArray();
        }
        else
        $down_data = WonProject::where('project_start_date','>=',$request->start)->where('project_start_date','<=',$request->end)->get(['client_id','rfq_no','total_margin','vendor_total','client_total'])->toArray();
       
        return $down_data;
    }
    
    
}

