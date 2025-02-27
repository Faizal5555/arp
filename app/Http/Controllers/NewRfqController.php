<?php

namespace App\Http\Controllers;

use App\Models\NewRfq;
use App\Models\RfqDetailsTable;
use App\Models\RfqSingleCountry;
use App\Models\RfqMultipleCountry;
use App\Models\RfqInterviewDepth;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\RfqOnlineCommunity;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class NewRfqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

        $bidrfq="";
        $bidrfq=[];
        $user = Auth::user(); 
        if ($user->user_type == 'admin') {
            // Admin sees all vendors and clients
            $client = Client::all();
        } else {
            // Sales users only see data linked to their user ID
            $client = Client::where('user_id', $user->id)->get();
        }

        $unique_no = RfqDetailsTable::orderBy('id', 'DESC')->with('rfq_no','rfq_no')->pluck('id')->first();

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
        

        return view('newrfq.index',compact('client','bidrfq','rfq_no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
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
                "error" => $validator->errors()
            ], 422);
        }
        // Generate RFQ number
        //$rfq_no = "RFQ-" . now()->format('Ymd') . rand(100, 999);
    
        // Insert into `rfq_details_tables`
        $rfq = new RfqDetailsTable();
        $rfq->date = $request->date;
        $rfq->industry = $request->industry;
        $rfq->follow_up_date = $request->follow_up_date;
        $rfq->company_name = $request->company_name;
        $rfq->rfq_no = $request->rfq_no;
        $rfq->user_id = auth()->user()->id;
        if ($rfq->save()) {
            
            if($request->single_form == 1)
            {
                $single = new RfqSingleCountry;
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
            if($request->multiple_form == 1)
            {
                $multiple = new RfqMultipleCountry();
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
            if($request->interview_form == 1)
            {
                $interview = new RfqInterviewDepth();
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
            if($request->online_form == 1)
            {
                $online = new RfqOnlineCommunity();
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

            return response()->json([
                "success" => 1,
                "message" => "RFQ Created Successfully",
                "rfq_id" => $rfq->id
            ], 201);
        } else {
            return response()->json([
                "success" => 0,
                "message" => "Database Error"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewRfq  $newRfq
     * @return \Illuminate\Http\Response
     */
    public function show(NewRfq $newRfq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewRfq  $newRfq
     * @return \Illuminate\Http\Response
     */
    public function edit(NewRfq $newRfq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewRfq  $newRfq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewRfq $newRfq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewRfq  $newRfq
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewRfq $newRfq)
    {
        //
    }
}
