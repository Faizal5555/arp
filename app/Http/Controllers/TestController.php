<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\Client;
use App\Models\BidRfq;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use DataTables;
use Illuminate\Support\Str;

class TestController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
                  
            $data = BidRfq::where('user_id',Auth()->user()->id)->get();
   
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('rfq_no'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['rfq_no'], $request->get('rfq_no')) ? true : false;
                            });
                        }

                        if (!empty($request->get('client_name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['client_name'], $request->get('client_name')) ? true : false;
                            });
                        }
                        if (!empty($request->get('date'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['date'], $request->get('date')) ? true : false;
                            });
                        }
                        if (!empty($request->get('follow_up_date'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['follow_up_date'], $request->get('follow_up_date')) ? true : false;
                            });
                        }
   
                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['rfq_no']), Str::lower($request->get('search')))){
                                    return true;
                                }elseif (Str::contains(Str::lower($row['client_name']), Str::lower($request->get('search')))) {
                                    return true;
                                }elseif (Str::contains(Str::lower($row['date']), Str::lower($request->get('search')))) {
                                    return true;
                                }elseif (Str::contains(Str::lower($row['follow_up_date']), Str::lower($request->get('search')))) {
                                    return true;
                                }
   
                                return false;
                            });
                        }
   
                    })
                    ->addColumn('action', function($row){
  
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
  
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('test.index');
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
        return view('test.create',compact('bidrfq','rfq_no','client','vendor','country'));
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
        // dd($v);
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
    
        if (!$validator->fails()) {
            // dd($req->bidrfqCount);
            for($i=0; $i<$req->bidrfqCount; $i++)
            {
                
                // dd( implode(',',$req->$a));
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

                $bidrfq->rfq_no = $req->rfq_no;
                $bidrfq->client_id = implode(',',$req->$client_id);
                $bidrfq->vendor_id = implode(',',$req->$vendor_id);
                $bidrfq->date = $req->date;
                $bidrfq->industry = $req->industry;
                $bidrfq->follow_up_date = $req->follow_up_date;
                // $bidrfq->industry_table = $req->industry_table;
                $bidrfq->sample_size = implode(',',$req->$sample_size);
                $bidrfq->setup_cost = implode(',',$req->$setup_cost);
                $bidrfq->recruitment = implode(',',$req->$recruitment);
                $bidrfq->incentives = implode(',',$req->$incentives);
                $bidrfq->moderation = implode(',',$req->$moderation);
                $bidrfq->transcript = implode(',',$req->$transcript);
                $bidrfq->others = implode(',',$req->$others);
                $bidrfq->country = implode(',',$req->$country);
                $bidrfq->total_cost = implode(',',$req->$total_cost);
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
                $bidrfq->rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        
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
        $country = Country::get();
        $vendor = Vendor::get();
        $client = Client::get();
        $bidrfq = BidRfq::where('id', $id)->first();
        // dd($bidrfq);
        // $string = $bidrfq->sample_size;
        // dd(explode(" ",$string));
        return view('test.edit',compact('bidrfq','client','vendor','country','id'));
    }
    
    public function update(Request $req)
    {
        $v = $req->all();
    
        $validator = Validator::make(
            $v,
            []
        );
    
        if (!$validator->fails()) {
            $bidrfq = BidRfq::where('id', $req->id)->first();
            $bidrfq->client_id = $req->client_id;
            $bidrfq->vendor_id = $req->vendor_id;
            $bidrfq->date = $req->date;
            $bidrfq->industry = $req->industry;
            $bidrfq->follow_up_date = $req->follow_up_date;
            $bidrfq->industry_table = $req->industry_table;
            $bidrfq->sample_size = $req->sample_size;
            $bidrfq->setup_cost = $req->setup_cost;
            $bidrfq->recruitment = $req->recruitment;
            $bidrfq->incentives = $req->incentives;
            $bidrfq->moderation = $req->moderation;
            $bidrfq->transcript = $req->transcript;
            $bidrfq->others = $req->others;
            $bidrfq->country = $req->country;
            $bidrfq->total_cost = $req->total_cost;
            $bidrfq->user_id = auth()->user()->id;
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
            $bidrfq->rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
            if ($bidrfq->save()) {
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

        $school= BidRfq::where('id',$id)->firstorfail()->delete();

        if($school)
        {
            $response_data = ["success" => 1, "message" => "School Deleted Successfully"];
            return redirect()->route('test.index');
        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }

        return response()->json($response_data);
        
    }
    public function search(Request $request)
    {
        
        // $bidrfq = BidRfq::where('sample_size', 'like','%'.$request->search.'%')->orWhere('setup_cost','like','%'.$request->search.'%')->get();

        // $time = BidRfq::where('user_id',Auth()->user()->id)->get();
        
        // return datatables()::of($time)->make(true);

            // if ($request->ajax()) {
                  
                $data = BidRfq::where('user_id',Auth()->user()->id)->get();
       
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->filter(function ($instance) use ($request) {
                            if (!empty($request->get('rfq_no'))) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    return Str::contains($row['rfq_no'], $request->get('rfq_no')) ? true : false;
                                });
                            }
       
                            if (!empty($request->get('search'))) {
                                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                    if (Str::contains(Str::lower($row['rfq_no']), Str::lower($request->get('search')))){
                                        return true;
                                    }else if (Str::contains(Str::lower($row['setup_cost']), Str::lower($request->get('search')))) {
                                        return true;
                                    }
       
                                    return false;
                                });
                            }
       
                        })
                        ->addColumn('action', function($row){
      
                               $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
      
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            // }
        
            return view('test.index');
        
    }
    
}
