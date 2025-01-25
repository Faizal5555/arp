<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidRfq;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\WonProject;
use App\Models\OperationNew;
use App\Models\Supplier;
use App\Models\supplieremailcontent;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendorrequestbalance;
use App\Models\Vendorrequestadvance;
use App\Models\clientrequestbalance;
use App\Models\Clientrequest;
use App\Models\datacenternew;
use App\Models\sendmoneynotification;
use App\Models\Country;
use App\Models\User;
use App\Models\adminMoneysend;
use App\Models\adminvoucher;
use App\Models\Speciality;
use App\Models\Fieldteam;
use App\Models\Doctornotification;
use Carbon\Carbon;
use App\Models\Que;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
    //   sales
         $operation1 = OperationNew::count();
        $closed1 = OperationNew::where('status','completed')->count();
        $field_team = Fieldteam::count();
        $total_supplier= Supplier :: count();
        $total_cost_request=Supplier::where('email_content','!=','')->count();


        $user = Auth::user();
       
        $TotalRFQsBid="";
        $won_project_1="";
        $TotalClientvalue="";
        $TotalVendorValue="";
        $TotalMarginValue="";
        $totalNoOfprojects="";
        $TotalLostProjects="";
        $pendingFollow="";
        
        // operation

        $closed = "";
        $new = "";
        $operation = OperationNew::get();
        if ($user->user_role === 'project_manager') {
            // Get operations where the logged-in user is the project manager
            $operation = OperationNew::where('project_manager_name', $user->id)->get();
        }
        $country=Country::get();
        $speciality=Speciality::get();
        $datacenter=datacenternew::get();
        $datacenter1=datacenternew::count();
        
        // field team
         $fieldteam=Fieldteam::orderBy('id', 'desc')->take(5)->get();
         $team_leader=Fieldteam::select('team_leader')->count();
         $total_close = OperationNew::where('status','completed')->count();
         $total_open = OperationNew::where('status','hold')->count();
         $project_manager_name=Fieldteam::select('project_manager_name')->count();
         $quality_analyst_name=Fieldteam::select('quality_analyst_name')->count();
        
       
     
       
        
       

        //for chart New project

        $newusers =OperationNew::select('id', 'created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); 
        });

        $newmcount = [];
        $newArr = [];
        
        foreach ($newusers as $key => $value) {
            $newmcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($newmcount[$i])){
                $newArr[$i] = $newmcount[$i];    
            }else{
                $newArr[$i] = 0;    
            }
        }

        //for chart Existing project

        $existusers = OperationNew::select('id', 'created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); 
        });

        $existcount = [];
        $existArr = [];
        
        foreach ($existusers as $key => $value) {
            $existcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($existcount[$i])){
                $existArr[$i] = $existcount[$i];    
            }else{
                $existArr[$i] = 0;    
            }
        }

        //for chart Completed project

        $closedusers = OperationNew::select('id', 'created_at')->where('status','completed')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        
        

        $closedcount = [];
        $closedArr = [];
        
        foreach ($closedusers as $key => $value) {
            $closedcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($closedcount[$i])){
                $closedArr[$i] = $closedcount[$i];    
            }else{
                $closedArr[$i] = 0;    
            }
        }
        
        $tl=User::where('user_role','team_leader')->get();
        $pl=User::where('user_role','project_manager')->get();
        $ql=User::where('user_role','quality_analyst')->get();
        $oh=User::where('user_role','operation_head')->get();
        
        
        //for accounts dashboard
        
         $vendor_balance_pending = Vendorrequestbalance::where('status','pending')->count();
        $vendor_advance_pending=Vendorrequestadvance::where('status','pending')->count();
        $client_balance_pending=clientrequestbalance::where('status','pending')->count();
        $client_advance_pending=Clientrequest::where('status','pending')->count();

        $total_client_invoice_pendig = $client_balance_pending + $client_advance_pending;
        $total_vendor_invoice_pending =$vendor_balance_pending + $vendor_advance_pending;


        $vendor_balance_awaited  = Vendorrequestbalance::where('status','awaited')->count();
        $vendor_advance_awaited =Vendorrequestadvance::where('status','awaited')->count();
        $client_balance_awaited =clientrequestbalance::where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::where('status','awaited')->count();
        $total_vendor_invoice_awaited =$vendor_balance_awaited + $vendor_advance_awaited;
        $total_client_invoice_awaited = $client_balance_awaited + $client_advance_awaited + $vendor_balance_awaited + $vendor_advance_awaited;

        
        
        
        $unique_no = datacenternew::orderBy('id', 'Desc')->pluck('id')->first();
        
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
         $pno_no = 'RNOD'.$unique_no. '-' .$dt->year;
       
 
          
        
        
        
        
        if($user->user_type == ('sales')){
                 $userType=auth()->user()->user_type;
                 $userId = auth()->user()->id;
                 $vendor = Vendor::where('user_id',$userId)->count();
                 $client = Client::where('user_id',$userId)->count();
                 $lost=  BidRfq::where('user_id',$userId)->where('type','lost')->count();
                 $next=  BidRfq::where('user_id',$userId)->where('type','next')->count();
                 $won=  BidRfq::where('user_id',$userId)->where('type','won')->count();
                 $bidrfq=bidrfq::get();
                 $bidrfq1=Bidrfq::where('user_id',$userId)->count();
                 $bid=Bidrfq::where('user_id',$userId)->count();
                 $won_project = WonProject::where('user_id',$userId)->count();
                 $totalrevenue=WonProject::where('user_id',$userId)->sum('client_total','+','vendor_total');
                 $totalmargin=Wonproject::where('user_id',$userId)->sum('total_margin');
            
            return view('dashboard',compact('bidrfq1','bidrfq','vendor','client','won_project','lost' ,'next','won','TotalRFQsBid','won_project_1','TotalClientvalue','TotalVendorValue',"TotalMarginValue","totalNoOfprojects","TotalLostProjects","pendingFollow","totalrevenue","totalmargin"));
        }elseif($user->user_type == ('operation')){
            return view('operationdashboard',compact('new','closed','operation','tl','pl','ql','oh'));
        }elseif($user->user_type == ('operation_head')){
            return view('operation_head',compact('new','closed','operation','tl','pl','ql','oh'));
        }elseif($user->user_type == ('field_team')){
            return view('fielddashboard',compact('team_leader','quality_analyst_name','project_manager_name','fieldteam','total_close','total_open'));
        }elseif($user->user_type == ('accounts')){
           return view('accountdashboard',compact('total_client_invoice_pendig','total_vendor_invoice_pending','total_client_invoice_awaited','total_vendor_invoice_awaited'));
        }elseif($user->user_type == ('supplier')){
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
        }elseif($user->user_type == ('data_center')){
                $country =Country::get();
                   
                   $speciality=Speciality::get();
                  $doctor = datacenternew::count();
                  $doctorRedeemAcceptList = adminMoneysend::where('status','Pending')->count();
                //   dd($doctorRedeemAcceptList);
                //   dd($doctornotification);
                 $doctornotificationmoney = Doctornotification::where('status','2')->where('message_type','money')->count();
                 $doctornotification1 = Doctornotification::where('status','1')->where('message_type','vocher')->count();
                 $doctornotification2 = Doctornotification::where('status','0')->where('message_type','reg')->count();
                  $doctornotificationmv =$doctornotificationmoney+$doctornotification1;
                 $doctornotification =$doctornotificationmoney+$doctornotification1+$doctornotification2 ;
                return view('DataCenter.admin_doctor_dashboard',compact('doctor','doctornotificationmoney','doctornotification','doctornotification1','doctornotification2','doctornotificationmv','doctorRedeemAcceptList','country','speciality'));
            // return view('DataCenter.newRegistration',compact('country','speciality','pno_no'));
        }elseif($user->user_type ==('doctor')){
            
            // $doctor=datacenternew::where('user_id',Auth::user()->id)->first();
            //  return view('DataCenter.DocterDashboard',compact('doctor','country'));
            
             // doctor notification
         $doctornotification = Doctornotification::where('user_id','=',Auth::user()->id)->where('status','0')->count();
         //  dd($doctornotification);
         $doctornotificationmoney = Doctornotification::where('user_id','=',Auth::user()->id)->where('status','0')->where('message_type','money')->count();
         $doctornotification1 = Doctornotification::where('user_id','=',Auth::user()->id)->where('status','0')->where('message_type','vocher')->count();
            
            $money_count =adminMoneysend::where('User_id',auth::user()->id)->where('status','Money Sent')->count();
            $voucher_count=adminvoucher::where('user_id',auth::user()->id)->where('status','Pending')->count();
              return view('DataCenter.docter_dashboard',compact('money_count','voucher_count','doctornotification','doctornotificationmoney','doctornotification1'));
         }
        elseif($user->user_type == ('admin')){
            // dd("hi");
                 $vendor = Vendor::count();
                 $client = Client::count();
                 $lost=  BidRfq::where('type','lost')->count();
                 $next=  BidRfq::where('type','next')->count();
                 $won=  BidRfq::where('type','won')->count();
                 $bidrfq=bidrfq::get();
                 $bidrfq1=Bidrfq::count();
                 $bid=Bidrfq::count();
                 $won_project = WonProject::count();
                 $totalrevenue=WonProject::sum('client_total','+','vendor_total');
                 $totalmargin=Wonproject::sum('total_margin');
            return view('salesdashboard',compact('bid','bidrfq','vendor','client','won_project','lost' ,'next','won','TotalRFQsBid','won_project_1','TotalClientvalue','TotalVendorValue',"TotalMarginValue","totalNoOfprojects","TotalLostProjects","pendingFollow","totalrevenue","totalmargin","operation1","closed1","field_team","total_supplier","total_cost_request","datacenter1"));
        }elseif($user->user_type == ('user')){
            $countries =Country::get();
            return view ('user.consumer_dashboard',compact('countries'));
        }elseif($user->user_type == ('global_manager')){
            $countries =Country::get();
            return view ('DataCenter.global_dashboard',compact('countries'));
        }elseif($user->user_type == ('global_team')){
            $countries =Country::get();

            return view ('user.consumer_dashboard',compact('countries'));
        }
        // $dashboard = '';
        // return view('index',compact('dashboard'));
    }
    
    public function operationindex()
    {
        $user = Auth::user();
        // if($user->user_type == 'admin')
        // {
        //     return view('dashboard');
        // }
        // $vendor = Vendor::count();
        // $client = Client::count();
        // $lost=  BidRfq::where('type','lost')->count();
        // $won_project = WonProject::count();
        // $bid=Bidrfq::count();
        
         $user = Auth::user();
        $vendor = Vendor::count();
        $client = Client::count();
        $lost=  BidRfq::where('type','lost')->count();
        $next=  BidRfq::where('type','next')->count();
        $won=  BidRfq::where('type','won')->count();
        
       
        $won_project = WonProject::count();
        
        
        $bidrfq1=Bidrfq::count();
        $bidrfq=bidrfq::get();
        $TotalRFQsBid="";
        $won_project_1="";
        $TotalClientvalue="";
        $TotalVendorValue="";
        $TotalMarginValue="";
        $totalNoOfprojects="";
        $TotalLostProjects="";
        $pendingFollow="";
        
        $closed=OperationNew::where('status','completed')->count();
        $new=OperationNew::count();
        $operation=OperationNew::latest()->take(5)->get();
         $tl=User::where('user_role','team_leader')->get();
        $pl=User::where('user_role','project_manager')->get();
        $ql=User::where('user_role','quality_analyst')->get();
        
         //for chart New project

        $newusers =OperationNew::select('id', 'created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); 
        });

        $newmcount = [];
        $newArr = [];
        
        foreach ($newusers as $key => $value) {
            $newmcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($newmcount[$i])){
                $newArr[$i] = $newmcount[$i];    
            }else{
                $newArr[$i] = 0;    
            }
        }

        //for chart Existing project

        $existusers = OperationNew::select('id', 'created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); 
        });

        $existcount = [];
        $existArr = [];
        
        foreach ($existusers as $key => $value) {
            $existcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($existcount[$i])){
                $existArr[$i] = $existcount[$i];    
            }else{
                $existArr[$i] = 0;    
            }
        }

        //for chart Completed project

        $closedusers = OperationNew::select('id', 'created_at')->where('status','completed')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $closedcount = [];
        $closedArr = [];
        
        foreach ($closedusers as $key => $value) {
            $closedcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($closedcount[$i])){
                $closedArr[$i] = $closedcount[$i];    
            }else{
                $closedArr[$i] = 0;    
            }
        }
        
        
        // if($user->user_type == ('sales')){
        //     return view('dashboard',compact('bidrfq1','bidrfq','vendor','client','won_project','lost' ,'next','won','TotalRFQsBid','won_project_1','TotalClientvalue','TotalVendorValue',"TotalMarginValue","totalNoOfprojects","TotalLostProjects","pendingFollow"));
        // }elseif($user->user_type == ('operation')){
        //     return view('operationdashboard',compact('new','closed','operation','newArr','existArr','closedArr'));
        // }elseif($user->user_type == ('field_team')){
        //     return view('fielddashboard');
        // }elseif($user->user_type == ('accounts')){
        //     return view('accountsdashboard');
        // }elseif($user->user_type == ('supplier')){
        //     return view('supplierdashboard');
        // }elseif($user->user_type == ('data_center')){
        //     return view('DataCenter.newRegistration');
        // }elseif($user->user_type == ('admin')){
        //     return view('dashboard',compact('bidrfq1','bidrfq','vendor','client','won_project','lost' ,'next','won','TotalRFQsBid','won_project_1','TotalClientvalue','TotalVendorValue',"TotalMarginValue","totalNoOfprojects","TotalLostProjects","pendingFollow"));
        // }
        // $dashboard = '';
        // return view('index',compact('dashboard'));
         return view('operationdashboard',compact('new','closed','operation','newArr','existArr','closedArr','tl','pl','ql'));
    }
    public function sales(){
        // dd("hi");
         $bidrfq1=Bidrfq::count();
         $bidrfq=bidrfq::get();
         $vendor = Vendor::count();
         $client = Client::count();
        //  /dd($client);
         $won_project = WonProject::count();
         $lost=  BidRfq::where('type','lost')->count();
         $next=  BidRfq::where('type','next')->count();
         $won=  BidRfq::where('type','won')->count();
         $TotalRFQsBid="";
        $won_project_1="";
        $TotalClientvalue="";
        $TotalVendorValue="";
        $TotalMarginValue="";
        $totalNoOfprojects="";
        $TotalLostProjects="";
        $pendingFollow="";
          $totalrevenue=WonProject::sum('client_total','+','vendor_total');
        $totalmargin=Wonproject::sum('total_margin');
          
       return view('dashboard',compact('bidrfq1','bidrfq','vendor','client','won_project','lost' ,'next','won','TotalRFQsBid','won_project_1','TotalClientvalue','TotalVendorValue',"TotalMarginValue","totalNoOfprojects","TotalLostProjects","pendingFollow","totalrevenue","totalmargin"));  
    }
    public function dashboard()
    {
        $dashboard = '';
        return view('dashboard',compact('dashboard'));
    }
    public function ChartjS(Request $request){
        $sum =0 ;
        $Total_margin = WonProject::where('project_start_date','>=',$request->start_1)->where('project_start_date','<=',$request->end_1)->get('total_margin');
         
        foreach($Total_margin as $t)
        {
            $sum = $sum + $t->total_margin;
        }
      
        $Total_invoice= WonProject::selectraw("SUM(client_total) as client_total,SUM(vendor_total) as vendor_total")->where('project_start_date','>=',$request->start_1)->where('project_start_date','<=',$request->end_1)->first()->toArray();
        $client_1= $Total_invoice['client_total'];
        $vendor_1= $Total_invoice['vendor_total'];
        $won_project=wonProject::count();
        $RFQS_Bid=BidRfq::get();
        $RFQS_Bid_count=count($RFQS_Bid);
        $lost=  BidRfq::where('type','lost')->count();
        $won=   BidRfq::where('type','won')->count();
        $next=  BidRfq::where('type','next')->count();
        return response()->json(["Total_margin"=>$Total_margin,"client_1"=>$client_1,"vendor_1"=>$vendor_1,"won_project_count"=>$won_project,"RFQS_Bid_count"=>$RFQS_Bid_count,"lost"=>$lost,"won"=>$won,"next"=>$next,"sum"=>$sum]); 
    }

    
    
    
      public function accountoverview()
    {
       
        $vendor_balance_pending = Vendorrequestbalance::where('status','pending')->count();
        $vendor_advance_pending=Vendorrequestadvance::where('status','pending')->count();
        $client_balance_pending=clientrequestbalance::where('status','pending')->count();
        $client_advance_pending=Clientrequest::where('status','pending')->count();
        $total_client_invoice_pendig = $client_balance_pending + $client_advance_pending;
        $total_vendor_invoice_pending =$vendor_balance_pending + $vendor_advance_pending;
        $vendor_balance_awaited  = Vendorrequestbalance::where('status','awaited')->count();
        $vendor_advance_awaited =Vendorrequestadvance::where('status','awaited')->count();
        $client_balance_awaited =clientrequestbalance::where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::where('status','awaited')->count();
        $total_vendor_invoice_awaited =$vendor_balance_awaited + $vendor_advance_awaited;
        $total_client_invoice_awaited = $client_balance_awaited + $client_advance_awaited + $vendor_balance_awaited + $vendor_advance_awaited;
        
        $inr=Clientrequest::where('currency','₹')->where('status','pending')->sum('amount');
        $usd=Clientrequest::where('currency','$')->where('status','pending')->sum('amount');
        $euro=Clientrequest::where('currency','€')->where('status','pending')->sum('amount');
        
        $inr1=Vendorrequestadvance::where('currency','₹')->where('status','pending')->sum('amount');
        $usd1=Vendorrequestadvance::where('currency','$')->where('status','pending')->sum('amount');
        $euro1=Vendorrequestadvance::where('currency','€')->where('status','pending')->sum('amount');
        
        return view('accountdashboard',compact('total_client_invoice_pendig','total_vendor_invoice_pending','total_client_invoice_awaited','total_vendor_invoice_awaited','inr','usd','euro','inr1','usd1','euro1'));
    }


    public function accountsoverview1(Request $request){

        
        // dd($request->all());
        if($request->start_1 == $request->end_1){
            
            // received
        $Total_Client_Payment_Received =Clientrequest::wheredate('created_at','=',$request->start_1)->where('status','paid')->sum('amount');
        $tcr_inr=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','₹')->where('status','paid')->sum('amount');
        $tcr_usd=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','$')->where('status','paid')->sum('amount');
        $tcr_euro=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','€')->where('status','paid')->sum('amount');
        $tcr_pound=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','£')->where('status','paid')->sum('amount');
        
        $Total_Vendor_Payment_Received =Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('status','paid')->sum('amount');
        // dd($Total_Vendor_Payment_Received);
        $tvr_inr=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','₹')->where('status','paid')->sum('amount');
        $tvr_usd=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','$')->where('status','paid')->sum('amount');
        $tvr_euro=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','€')->where('status','paid')->sum('amount');
        $tvr_pound=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','£')->where('status','paid')->sum('amount');
        
        // end received
       
        $vendor_balance_pending = Vendorrequestbalance::wheredate('created_at','=',$request->start_1)->where('status','pending')->count();
        $vendor_advance_pending=Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('status','pending')->count();
        $client_balance_pending=clientrequestbalance::wheredate('created_at','=',$request->start_1)->where('status','pending')->count();
        $client_advance_pending=Clientrequest::wheredate('created_at','=',$request->start_1)->where('status','pending')->count();
        $total_client_invoice_pendig = $client_balance_pending + $client_advance_pending;
        $total_vendor_invoice_pending =$vendor_balance_pending + $vendor_advance_pending;
        $inr=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','₹')->where('status','pending')->sum('amount');
        $usd=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','$')->where('status','pending')->sum('amount');
        $euro=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','€')->where('status','pending')->sum('amount');
        $pound=Clientrequest::wheredate('created_at','=',$request->start_1)->where('currency','£')->where('status','pending')->sum('amount');
        
        $inr1=Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('currency','₹')->where('status','pending')->sum('amount');
        $usd1=Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('currency','$')->where('status','pending')->sum('amount');
        $euro1=Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('currency','€')->where('status','pending')->sum('amount');
        $pound1=Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('currency','£')->where('status','pending')->sum('amount');
        // $vendor_balance_awaited  = Vendorrequestbalance::wheredate('created_at','=',$request->start_1)->where('status','awaited')->count();
        // $vendor_advance_awaited =Vendorrequestadvance::wheredate('created_at','=',$request->start_1)->where('status','awaited')->count();
        // $client_balance_awaited =clientrequestbalance::wheredate('created_at','=',$request->start_1)->where('status','awaited')->count();
        // $client_advance_awaited =Clientrequest::wheredate('created_at','=',$request->start_1)->where('status','awaited')->count();
        // $total_vendor_invoice_awaited =$vendor_balance_awaited + $vendor_advance_awaited;
        
        $vendor_advance_awaited =Vendorrequestadvance::wheredate('updated_at','=',$request->start_1)->where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::wheredate('updated_at','=',$request->start_1)->where('status','awaited')->count();
        $total_client_invoice_awaited =  $client_advance_awaited + $vendor_advance_awaited;
        
        
            
        }else
        {
        
        $Total_Client_Payment_Received =Clientrequest::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','paid')->sum('amount');
        
        $tcr_inr=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->where('status','paid')->sum('amount');
        $tcr_usd=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->where('status','paid')->sum('amount');
        $tcr_euro=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->where('status','paid')->sum('amount');
        $tcr_pound=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->where('status','paid')->sum('amount');
       
        $Total_Vendor_Payment_Received =Vendorrequestadvance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','paid')->sum('amount');
        // dd($Total_Vendor_Payment_Received);
        
        $tvr_inr=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->where('status','paid')->sum('amount');
        $tvr_usd=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->where('status','paid')->sum('amount');
        $tvr_euro=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->where('status','paid')->sum('amount');
        $tvr_pound=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->where('status','paid')->sum('amount');
        
           
        $vendor_balance_pending = Vendorrequestbalance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','pending')->count();
        $vendor_advance_pending=Vendorrequestadvance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','pending')->count();
        $client_balance_pending=clientrequestbalance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','pending')->count();
        $client_advance_pending=Clientrequest::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','pending')->count();
        $total_client_invoice_pendig = $client_balance_pending + $client_advance_pending;
        $total_vendor_invoice_pending =$vendor_balance_pending + $vendor_advance_pending;
        
        $inr=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->where('status','pending')->sum('amount');
        $usd=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->where('status','pending')->sum('amount');
        $euro=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->where('status','pending')->sum('amount');
        $pound=Clientrequest::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->where('status','pending')->sum('amount');
        
        $inr1=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->where('status','pending')->sum('amount');
        $usd1=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->where('status','pending')->sum('amount');
        $euro1=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->where('status','pending')->sum('amount');
        $pound1=Vendorrequestadvance::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->where('status','pending')->sum('amount');
        // $vendor_balance_awaited  = Vendorrequestbalance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','awaited')->count();
        // $vendor_advance_awaited =Vendorrequestadvance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','awaited')->count();
        // $client_balance_awaited =clientrequestbalance::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','awaited')->count();
        // $client_advance_awaited =Clientrequest::where('created_at','>=',$request->start_1)->where('created_at','<=',$request->end_1)->where('status','awaited')->count();
        // $total_vendor_invoice_awaited =$vendor_balance_awaited + $vendor_advance_awaited;
        // $total_client_invoice_awaited = $client_balance_awaited + $client_advance_awaited + $vendor_balance_awaited + $vendor_advance_awaited;
        
        $vendor_advance_awaited =Vendorrequestadvance::wheredate('updated_at','>=',$request->start_1)->wheredate('updated_at','<=',$request->end_1)->where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::wheredate('updated_at','>=',$request->start_1)->wheredate('updated_at','<=',$request->end_1)->where('status','awaited')->count();
        $total_client_invoice_awaited =  $client_advance_awaited + $vendor_advance_awaited;
        }
        
        
        return response()->json(["total_client_invoice_pendig"=>$total_client_invoice_pendig,"total_vendor_invoice_pending"=>$total_vendor_invoice_pending,"total_client_invoice_awaited"=>$total_client_invoice_awaited,"inr"=>$inr,"inr1"=>$inr1,"usd"=>$usd,"usd1"=>$usd1,"euro"=>$euro,"euro1"=>$euro1,"pound"=>$pound,"pound1"=>$pound1,"TVPR"=>$Total_Vendor_Payment_Received,"TCPR"=>$Total_Client_Payment_Received,"tcr_inr"=>$tcr_inr,"tcr_usd"=>$tcr_usd,"tcr_euro"=>$tcr_euro,"tcr_pound"=>$tcr_pound,"Total_Vendor_Payment_Received"=>$Total_Vendor_Payment_Received,"tvr_usd"=>$tcr_usd,"tvr_inr"=>$tcr_inr,"tvr_euro"=>$tcr_euro,"tcr_pound"=>$tcr_pound]);   
        
    }
 
 public function adminDate(Request $req){
        $total_supplier= Supplier::select('*');
        $total_cost_request=supplieremailcontent::select('*');
        if($req->start_1 ==$req->end_1){
            
         $Total_invoice1= WonProject::wheredate('created_at','=',$req->start_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::select('vendor_total')->whereDate('created_at','>=',$req->start_1)->whereDate('created_at','<=',$req->end_1)->get()->toArray();
             $sum1 = 0 ;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
            $client_1= $Total_invoice;
            
            $vendor_1= $sum1;
             $Total_Invoice_Value2= $client_1+$sum1;
            $Total_Invoice_Value1 = (int) $Total_Invoice_Value2;
            
        $Total_Rfq_Bid=BidRfq::wheredate('created_at','=',$req->start_1)->count();
        $Total_Won_Projects=WonProject::wheredate('created_at','=',$req->start_1)->count();
        $Total_Invoice_Value=WonProject::wheredate('created_at','=',$req->start_1)->sum('client_total','+','vendor_total');
        $Total_Margin_Value=WonProject::wheredate('created_at','=',$req->start_1)->sum('total_margin');
        $Total_No_of_projects= OperationNew::wheredate('created_at','=',$req->start_1)->count();
        $Total_Existing_Projects=OperationNew::wheredate('created_at','=',$req->start_1)->count();
        $Total_closed_projects=OperationNew::wheredate('created_at','=',$req->start_1)->where('status','completed')->count();
        $Field_Team_Projects=OperationNew::wheredate('created_at','=',$req->start_1)->count();
        $Client_invoices_pending=Clientrequest::wheredate('created_at','=',$req->start_1)->where('status','pending')->count();
        $Vendor_invoices_pending=Vendorrequestadvance::wheredate('created_at','=',$req->start_1)->where('status','pending')->count();
        
        $vendor_advance_awaited =Vendorrequestadvance::wheredate('updated_at','=',$req->start_1)->where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::wheredate('updated_at','=',$req->start_1)->where('status','awaited')->count();
        $Total_Payments_awaited=$vendor_advance_awaited+$client_advance_awaited;
        
        
        $Total_Suppliers_by_country=Supplier::wheredate('created_at','=',$req->start_1);
        $ids = $Total_Suppliers_by_country->pluck('id')->toArray();
        // dd($ids);
        $Total_Suppliers_by_country = $Total_Suppliers_by_country->count();
        $Total_Cost_request= supplieremailcontent::whereIn('supplier_id',$ids)->count();
        
        // $Total_Cost_request=Supplier::where('email_content','!=','')->wheredate('created_at','=',$req->start_1)->count();;
        
        $Total_doctor=datacenternew::wheredate('created_at','=',$req->start_1)->count();
        }
        else
        {
            $Total_invoice1= WonProject::whereDate('created_at','>=',$req->start_1)->whereDate('created_at','<=',$req->end_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::select('vendor_total')->whereDate('created_at','>=',$req->start_1)->whereDate('created_at','<=',$req->end_1)->get()->toArray();
             $sum1 = 0;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
              
             $client_1= $Total_invoice;
         
             $vendor_1= $sum1;
          
             
              $Total_Invoice_Value2= $client_1+$sum1;
            $Total_Invoice_Value1 = (int) $Total_Invoice_Value2;
            
        $Total_Rfq_Bid=BidRfq::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Total_Won_Projects=WonProject::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Total_Invoice_Value=WonProject::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->sum('client_total','+','vendor_total');
        $Total_Margin_Value=WonProject::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->sum('total_margin');
        $Total_No_of_projects= OperationNew::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Total_Existing_Projects=OperationNew::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Total_closed_projects=OperationNew::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->where('status','completed')->count();
        $Field_Team_Projects=Fieldteam::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Client_invoices_pending=Clientrequest::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->where('status','pending')->count();
        $Vendor_invoices_pending=Vendorrequestadvance::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->where('status','pending')->count();
      
        $vendor_advance_awaited =Vendorrequestadvance::wheredate('updated_at','>=',$req->start_1)->wheredate('updated_at','<=',$req->end_1)->where('status','awaited')->count();
        $client_advance_awaited =Clientrequest::wheredate('updated_at','>=',$req->start_1)->wheredate('updated_at','<=',$req->end_1)->where('status','awaited')->count();
        $Total_Payments_awaited=$vendor_advance_awaited+$client_advance_awaited;
        
        $Total_Suppliers_by_country=Supplier::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1);
        $ids = $Total_Suppliers_by_country->pluck('id')->toArray();
        // dd($ids);
        $Total_Suppliers_by_country = $Total_Suppliers_by_country->count();
        $Total_Cost_request= supplieremailcontent::whereIn('supplier_id',$ids)->count();
        // $Total_Cost_request= Supplier::where('email_content','!=','')->where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        $Total_doctor=datacenternew::where('created_at','>=',$req->start_1)->where('created_at','<=',$req->end_1)->count();
        }
        // ($req->all());
        
        
        return response()->json(['Total_Rfq_Bid'=> $Total_Rfq_Bid, 'Total_Won_Projects'=>$Total_Won_Projects,'Total_Invoice_Value1'=>$Total_Invoice_Value1, 'Total_Margin_Value'=>$Total_Margin_Value,'Total_No_of_projects'=> $Total_No_of_projects , 'Total_Existing_Projects'=>$Total_Existing_Projects,'Total_closed_projects'=> $Total_closed_projects,'Field_Team_Projects'=>$Field_Team_Projects,'Client_invoices_pending'=>$Client_invoices_pending,'Vendor_invoices_pending'=>$Vendor_invoices_pending,'Total_Payments_awaited'=>$Total_Payments_awaited,'Total_Suppliers_by_country'=>$Total_Suppliers_by_country,'Total_Cost_request'=>$Total_Cost_request,'Total_doctor'=>$Total_doctor,"client_1"=>$client_1,'vendor_1'=>$vendor_1]);
    }
    public function fieldindex(){
         $fieldteam=Fieldteam::orderBy('id', 'desc')->take(5)->get();
         $team_leader=Fieldteam::select('team_leader')->count();
         $total_close = OperationNew::where('status','completed')->count();
         $total_open = OperationNew::where('status','hold')->count();
         $project_manager_name=Fieldteam::select('project_manager_name')->count();
         $quality_analyst_name=Fieldteam::select('quality_analyst_name')->count();
        
          return view('fielddashboard',compact('team_leader','quality_analyst_name','project_manager_name','fieldteam','total_close','total_open'));
    }

    public function employeeList(Request $request)
   {
    // $quesRecords = DB::table('ques')
    // ->select(
    //     'link_id as user_id',
    //     DB::raw("CONCAT(fname, ' ', lname) as name"),
    //     'email',
    //     'country'
    // )
    // ->get();
    $quesRecords = DB::table('ques')
    ->join('users', 'ques.link_id', '=', 'users.id') // Join with `users` table
    ->select(
        'ques.link_id as user_id', // Use `link_id` as `user_id`
        DB::raw("CONCAT(ques.fname, ' ', ques.lname) as name"), // Concatenate first and last names
        'ques.email',
        'ques.country',
        DB::raw('(SELECT COUNT(*) FROM ques WHERE ques.user_id = users.id) as referral_consumer') // Count for consumer referrals
    )
    ->where('users.user_type', 'global_team') 
    ->whereNull('users.deleted_at')// Filter for `global_team` user type
    ->get()
    ->transform(function ($record) {
        // Calculate referral_hcp for consumers based on datacenternews table
        $record->referral_hcp = DB::table('datacenternews')
            ->where('datacenter_id', $record->user_id)
            ->count();
        return $record;
    });

$userRecords = DB::table('users')
    ->select(
        'id as user_id',
        'name',
        'email',
        'country',
        DB::raw('(SELECT COUNT(*) FROM ques WHERE ques.user_id = users.id) as referral_consumer') // Count for consumer referrals
    )
    ->where('user_type', 'global_team')
    ->whereNull('users.deleted_at')
    ->get()
    ->transform(function ($record) {
        // Calculate referral_hcp for HCPs based on datacenternews table
        $record->referral_hcp = DB::table('datacenternews')
            ->where('datacenter_id', $record->user_id)
            ->count();
        return $record;
    });

$consumerEmployees = $quesRecords->concat($userRecords);



    return view('DataCenter.employeelist', compact('consumerEmployees'));

// if (auth()->user()->user_type === 'global_manager') {
//     // Fetch the global team IDs assigned to the logged-in global manager
//     $globalTeamIds = DB::table('global_manager_team')
//         ->where('global_manager_id', auth()->user()->id)
//         ->pluck('global_team_id');

//     // Fetch the user records for the global teams assigned to this manager
//     $consumerEmployees = DB::table('users')
//         ->select(
//             'id as user_id',
//             'name',
//             'email',
//             'country'
//         )
//         ->where('user_type', 'global_team')
//         ->whereIn('id', $globalTeamIds) // Filter by global team IDs
//         ->get();

//     return view('DataCenter.employeelist', compact('consumerEmployees'));
// }

// // If the logged-in user is an admin, show all employees
// $quesRecords = DB::table('ques')
//     ->select(
//         'link_id as user_id',
//         DB::raw("CONCAT(fname, ' ', lname) as name"),
//         'email',
//         'country'
//     )
//     ->get();

// $userRecords = DB::table('users')
//     ->select(
//         'id as user_id',
//         'name',
//         'email',
//         'country'
//     )
//     ->where('user_type', 'global_team')
//     ->get();

// // Merge the data
// $consumerEmployees = $quesRecords->concat($userRecords);

// // Return the view with the data
// return view('DataCenter.employeelist', compact('consumerEmployees'));
   }

   public function consumerCountryfilter(Request $req)
{
    $country = $req->country;
    $user_id = isset($req->user_id) ? $req->user_id : auth()->user()->id;
    // Get the authenticated user
   // $authUser = auth()->user();
    $globalTeamQues = Que::where('user_id',$user_id);

    // Fetch the global team ques records associated with the authenticated user
    // $globalTeamQues = Que::whereHas('user', function ($query) use ($authUser) {
    //     $query->where('id', $authUser->id)
    //           ->where('user_type', 'global_team');
    // });


    // Apply country filter if provided
    if ($country) {
        $globalTeamQues->where('country', $country);
    }

    // Fetch the records
    $quesRecords = $globalTeamQues->get();

    // Step 1: Prepare data for the pie chart (country distribution)
    $userChartData = $quesRecords
        ->groupBy('country')
        ->map(function ($group) {
            return [
                'label' => $group->first()->country,
                'count' => $group->count(),
            ];
        })
        ->values();

    // Step 2: Prepare data for occupations (question 26)
    $occupationData = $quesRecords
        ->groupBy('que_26')
        ->map(function ($group, $key) {
            return [
                'label' => config("answer_key.answers.twentysix.{$key}", 'Unknown'),
                'count' => $group->count(),
            ];
        })
        ->values();

    // Step 3: Prepare data for industries (question 27)
    $industryData = $quesRecords
        ->groupBy('que_27')
        ->map(function ($group, $key) {
            return [
                'label' => config("answer_key.answers.twentyseven.{$key}", 'Unknown'),
                'count' => $group->count(),
            ];
        })
        ->values();

    // Step 4: Return the data as JSON response
    return response()->json([
        "userChartData" => $userChartData,
        "occupationData" => $occupationData,
        "industryData" => $industryData,
    ]);
}
   


   
   
   

   



//    public function viewDashboard($user_id, $type)
//    {
//        if ($type === 'consumer') {
//            // Fetch countries for the consumer dashboard
//            $countries = Country::all();
   
//            // Fetch global_team users associated with the given user_id
           
//            $globalTeamUserIds = DB::table('ques') // Assuming `ques` table links users
//                ->where('user_id', $user_id) // Filter for the specified user_id
//                ->pluck('id'); // Fetch global_team user IDs
   
//            // Prepare data for the charts
//            $userChartData = DB::table('ques')
//                ->select('country as label', DB::raw('count(*) as count'))
//                ->whereIn('id', $globalTeamUserIds) // Filter for associated users
//                ->groupBy('country')
//                ->get();
   
//            $occupationData = DB::table('ques')
//                ->select('que_26 as occupation', DB::raw('count(*) as count'))
//                ->whereIn('id', $globalTeamUserIds) // Filter for associated users
//                ->groupBy('que_26')
//                ->get();
   
//            $industryData = DB::table('ques')
//                ->select('que_27 as industry', DB::raw('count(*) as count'))
//                ->whereIn('id', $globalTeamUserIds) // Filter for associated users
//                ->groupBy('que_27')
//                ->get();
   
//            // Redirect to the consumer dashboard with global team users and chart data
//            return view('user.consumer_dashboard', compact('countries', 'user_id', 'userChartData', 'occupationData', 'industryData'));
//        } elseif ($type === 'hcp') {
//         // Fetch countries for the HCP dashboard
//             $countries = Country::all();

//             // Fetch HCP records for the pie chart
//             $countryChartData = datacenternew::select('country1 as label', DB::raw('count(*) as count'))
//                 ->groupBy('country1')
//                 ->get();

//             // Fetch HCP specialties for the bar chart
//             $specialityChartData = datacenternew::select('docterSpeciality as label', DB::raw('count(*) as count'))
//                 ->groupBy('docterSpeciality')
//                 ->get();

//             return view('user.hcp_dashboard', compact('countries', 'user_id', 'countryChartData', 'specialityChartData'));
//         } else {
//             // Invalid type - Show 404 error
//             abort(404, 'Invalid user type');
//         }
//    }


public function viewDashboard($user_id = null, $type = 'consumer')
{   
    // if ($user_id === null) {
    //     $user_id = auth()->user()->id;
    // }
    $user_id = isset($user_id) ? $user_id : auth()->user()->id;
    if ($type === 'consumer') {
        
        // Fetch countries for the consumer dashboard
        $countries = Country::all();

        // Handle user-specific or general data
        if ($user_id !== 'general') {
            $globalTeamUserIds = DB::table('ques')
                ->where('user_id', $user_id)
                ->pluck('id');

            $userChartData = DB::table('ques')
                ->select('country as label', DB::raw('count(*) as count'))
                ->whereIn('id', $globalTeamUserIds)
                ->groupBy('country')
                ->get();

            $occupationData = DB::table('ques')
                ->select('que_26 as occupation', DB::raw('count(*) as count'))
                ->whereIn('id', $globalTeamUserIds)
                ->groupBy('que_26')
                ->get();

            $industryData = DB::table('ques')
                ->select('que_27 as industry', DB::raw('count(*) as count'))
                ->whereIn('id', $globalTeamUserIds)
                ->groupBy('que_27')
                ->get();
        } else {
            // General data for all users
            $userChartData = DB::table('ques')
                ->select('country as label', DB::raw('count(*) as count'))
                ->groupBy('country')
                ->get();

            $occupationData = DB::table('ques')
                ->select('que_26 as occupation', DB::raw('count(*) as count'))
                ->groupBy('que_26')
                ->get();

            $industryData = DB::table('ques')
                ->select('que_27 as industry', DB::raw('count(*) as count'))
                ->groupBy('que_27')
                ->get();
        }

        return view('user.consumer_dashboard', compact('countries', 'user_id', 'userChartData', 'occupationData', 'industryData'));
    } elseif ($type === 'hcp') {
        // Fetch countries for the HCP dashboard
        $countries = Country::all();

        // Fetch HCP records for the pie chart
        $countryChartData = datacenternew::select('country1 as label', DB::raw('count(*) as count'))
            ->groupBy('country1')
            ->get();

        // Fetch HCP specialties for the bar chart
        $specialityChartData = datacenternew::select('docterSpeciality as label', DB::raw('count(*) as count'))
            ->groupBy('docterSpeciality')
            ->get();

        return view('user.hcp_dashboard', compact('countries', 'user_id', 'countryChartData', 'specialityChartData'));
    } else {
        // Invalid type - Show 404 error
        abort(404, 'Invalid user type');
    }
}


   public function hcpCountry(Request $request)
   {
       $country = $request->country;
   
       // Fetch `datacenternew` records associated with the given user_id
       $hcpRecords = datacenternew::where('datacenter_id', $request->user_id);
   
       // Apply country filter if provided
       if ($country) {
           $hcpRecords->where('country1', $country);
       }
   
       // Fetch the records
       $hcpData = $hcpRecords->get();
   
       // Step 1: Prepare data for the pie chart (country distribution)
       $countryChartData = $hcpData
           ->groupBy(function ($item) {
               // Normalize country names to title case
               return ucfirst(strtolower($item->country1));
           })
           ->map(function ($group, $key) {
               return [
                   'label' => $key, // The normalized country name
                   'count' => $group->count(),
               ];
           })
           ->values();
   
       // Step 2: Prepare data for specialties (doctorSpeciality)
       $specialityChartData = $hcpData
           ->groupBy(function ($item) {
               // Use a default label if speciality is null
               return $item->docterSpeciality ?: 'Unknown';
           })
           ->map(function ($group, $key) {
               return [
                   'label' => $key,
                   'count' => $group->count(),
               ];
           })
           ->values();
   
       // Step 3: Return the data as JSON response
       return response()->json([
           'countryChartData' => $countryChartData,
           'specialityChartData' => $specialityChartData,
       ]);
   }
   



    


    // Controller
    // Controller
    // public function globalDashboard(Request $request)
    // {
    //     $country = $request->input('country'); // Check for selected country
    //     $query = DB::table('ques')
    //         ->join('users', 'ques.user_id', '=', 'users.id')
    //         ->where('users.user_type', 'global_manager')
    //         ->select(
    //             DB::raw('COALESCE(ques.country, "Unknown") as label'),
    //             DB::raw('COUNT(ques.id) as count')
    //         );
    
    //     if ($country) {
    //         $query->where('ques.country', $country);
    //     }
    
    //     $countryChartData = $query->groupBy('ques.country')->get();
    
    //     return response()->json(['countryChartData' => $countryChartData]);
    // }

    public function globalDashboard(Request $request)
{
    $country = $request->input('country'); // Check for selected country

    // Country Distribution Data
    $countryQuery = DB::table('ques')
        ->join('users', 'ques.user_id', '=', 'users.id')
        ->where('users.user_type', 'global_manager')
        ->select(
            DB::raw('COALESCE(ques.country, "Unknown") as label'),
            DB::raw('COUNT(ques.id) as count')
        );

    if ($country) {
        $countryQuery->where('ques.country', $country);
    }

    $countryChartData = $countryQuery->groupBy('ques.country')->get();

    // Question 26 Data (Occupation)
    $occupationData = DB::table('ques')
        ->join('users', 'ques.user_id', '=', 'users.id')
        ->where('users.user_type', 'global_manager')
        ->select('ques.que_26 as occupation', DB::raw('COUNT(*) as count'));

    if ($country) {
        $occupationData->where('ques.country', $country);
    }

    $occupationChartData = $occupationData->groupBy('ques.que_26')->get()
        ->map(function ($item) {
            return [
                'label' => config("answer_key.answers.twentysix.{$item->occupation}", 'Unknown'),
                'count' => $item->count,
            ];
        });

    // Question 27 Data (Industry)
    $industryData = DB::table('ques')
        ->join('users', 'ques.user_id', '=', 'users.id')
        ->where('users.user_type', 'global_manager')
        ->select('ques.que_27 as industry', DB::raw('COUNT(*) as count'));

    if ($country) {
        $industryData->where('ques.country', $country);
    }

    $industryChartData = $industryData->groupBy('ques.que_27')->get()
        ->map(function ($item) {
            return [
                'label' => config("answer_key.answers.twentyseven.{$item->industry}", 'Unknown'),
                'count' => $item->count,
            ];
        });

    return response()->json([
        'countryChartData' => $countryChartData,
        'occupationChartData' => $occupationChartData,
        'industryChartData' => $industryChartData,
    ]);
}


    



    
}
