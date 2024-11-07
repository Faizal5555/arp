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
use DB;
use Yajra\DataTables\Facades\DataTables;



class OverviewController extends Controller
{
    public function Overview_chart(Request $request){
        if($request->start_1 ==$request->end_1){
            
           
            $won_project=wonProject::get();
            $lost=  BidRfq::wheredate('created_at','=',$request->start_1)->where('type','lost')->count();
            $won=   BidRfq::wheredate('created_at','=',$request->start_1)->where('type','won')->count();
            $next=  BidRfq::wheredate('created_at','=',$request->start_1)->where('type','next')->count();
            
            $userType=auth()->user()->user_type;
            // dd($userType);
            if($userType=="admin"){
             $sum =0 ;
            $Total_margin = WonProject::where('project_start_date','=',$request->start_1)->get('total_margin');
              foreach($Total_margin as $t)
             {
                 $sum = $sum + $t->total_margin;
             }
            $Total_invoice1= WonProject::wheredate('created_at','=',$request->start_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::select('vendor_total')->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get()->toArray();
            $sum1 = 0 ;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
            $client_1= $Total_invoice;
            
            $vendor_1= $sum1;
            //new
            $client_t=Client::wheredate('created_at','=',$request->start_1)->count();
            $vendor_t=Vendor::wheredate('created_at','=',$request->start_1)->count();
            $Total_Rfq_Bid=BidRfq::wheredate('created_at','=',$request->start_1)->count();
            $RFQS_Bid=BidRfq::wheredate('created_at','=',$request->start_1)->count();
            $RFQS_Bid_count=$RFQS_Bid;
            $Total_Won_Projects=WonProject::wheredate('created_at','=',$request->start_1)->count();
            //end new
            $Total_Invoice_Value2= $client_1+$sum1;
            $Total_Invoice_Value = (int) $Total_Invoice_Value2;
            $Total_Margin_Value=WonProject::wheredate('created_at','=',$request->start_1)->sum('total_margin');
            // currency
            $total_usd=WonProject::wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('total_margin');
            $total_inr=WonProject::wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('total_margin');
            $total_euro=WonProject::wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('total_margin');
            $total_pound=WonProject::wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('total_margin');
            $total_usd1= intval($total_usd);
            $total_inr1= intval($total_inr);
            $total_euro1= intval($total_euro);
            $total_pound1= intval($total_pound);
            // currency revenue
           $client_advance_usd=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('client_advance');
           $client_balance_usd=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('client_balance');
           $client_advance_inr=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('client_advance');
           $client_balance_inr=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('client_balance');
           $client_advance_euro=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('client_advance');
           $client_balance_euro=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('client_balance');
           $client_advance_pound=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('client_advance');
           $client_balance_pound=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('client_balance');
           $vendor_advance_usd=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('vendor_advance');
           $vendor_balance_usd=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('vendor_balance');
           $vendor_advance_inr=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('vendor_advance');
           $vendor_balance_inr=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('vendor_balance');
           $vendor_advance_euro=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('vendor_advance');
           $vendor_balance_euro=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('vendor_balance');
           $vendor_advance_pound=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('vendor_advance');
           $vendor_balance_pound=Wonproject::wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('vendor_balance');
           $client_usd= intval($client_advance_usd+ $client_balance_usd);
           $client_inr= intval($client_advance_inr+ $client_balance_inr);
           $client_euro= intval($client_advance_euro+ $client_balance_euro);
           $client_pound= intval($client_advance_pound+ $client_balance_pound);
           $vendor_usd= intval($vendor_advance_usd+ $vendor_balance_usd);
           $vendor_inr= intval($vendor_advance_inr+ $vendor_balance_inr);
           $vendor_euro= intval($vendor_advance_euro+ $vendor_balance_euro);
           $vendor_pound= intval($vendor_advance_pound+ $vendor_balance_pound);
           $revenue_usd=$client_usd+$vendor_usd;
           $revenue_inr=$client_inr+$vendor_inr;
           $revenue_euro=$client_euro+$vendor_euro;
           $revenue_pound=$client_pound+$vendor_pound;
            }
            else{
            $userId=auth()->user()->id;
            $sum =0 ;
            $Total_margin = WonProject::where('user_id',$userId)->where('project_start_date','=',$request->start_1)->get('total_margin');
              foreach($Total_margin as $t)
             {
                 $sum = $sum + $t->total_margin;
             }
            $Total_invoice1= WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::where('user_id',$userId)->select('vendor_total')->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get()->toArray();
            $sum1 = 0 ;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
            $client_1= $Total_invoice;
            
            $vendor_1= $sum1;
            //new
            $client_t=Client::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->count();
            $vendor_t=Vendor::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->count();
            $Total_Rfq_Bid=BidRfq::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->count();
            $RFQS_Bid=BidRfq::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->count();
            $RFQS_Bid_count=$RFQS_Bid;
            $Total_Won_Projects=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->count();
            //end new
            $Total_Invoice_Value2= $client_1+$sum1;
            $Total_Invoice_Value = (int) $Total_Invoice_Value2;
            $Total_Margin_Value=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->sum('total_margin');
            // currency
            $total_usd=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('total_margin');
            $total_inr=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('total_margin');
            $total_euro=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('total_margin');
            $total_pound=WonProject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('total_margin');
            $total_usd1= intval($total_usd);
            $total_inr1= intval($total_inr);
            $total_euro1= intval($total_euro);
            $total_pound1= intval($total_pound);
            // currency revenue
           $client_advance_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('client_advance');
           $client_balance_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('client_balance');
           $client_advance_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('client_advance');
           $client_balance_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('client_balance');
           $client_advance_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('client_advance');
           $client_balance_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('client_balance');
           $client_advance_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('client_advance');
           $client_balance_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('client_balance');
           $vendor_advance_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('vendor_advance');
           $vendor_balance_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','$')->sum('vendor_balance');
           $vendor_advance_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('vendor_advance');
           $vendor_balance_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','₹')->sum('vendor_balance');
           $vendor_advance_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('vendor_advance');
           $vendor_balance_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','€')->sum('vendor_balance');
           $vendor_advance_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('vendor_advance');
           $vendor_balance_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','=',$request->start_1)->where('currency','£')->sum('vendor_balance');
           $client_usd= intval($client_advance_usd+ $client_balance_usd);
           $client_inr= intval($client_advance_inr+ $client_balance_inr);
           $client_euro= intval($client_advance_euro+ $client_balance_euro);
           $client_pound= intval($client_advance_pound+ $client_balance_pound);
           $vendor_usd= intval($vendor_advance_usd+ $vendor_balance_usd);
           $vendor_inr= intval($vendor_advance_inr+ $vendor_balance_inr);
           $vendor_euro= intval($vendor_advance_euro+ $vendor_balance_euro);
           $vendor_pound= intval($vendor_advance_pound+ $vendor_balance_pound);
           $revenue_usd=$client_usd+$vendor_usd;
           $revenue_inr=$client_inr+$vendor_inr;
           $revenue_euro=$client_euro+$vendor_euro;
           $revenue_pound=$client_pound+$vendor_pound;
           }
           
           
          }else
          {
              
            $won_project=wonProject::get();
            $lost=  BidRfq::where('type','lost')->count();
            $won=   BidRfq::where('type','won')->count();
            $next=  BidRfq::where('type','next')->count();
            $userType=auth()->user()->user_type;
            if($userType=="admin"){
              $sum =0 ;
            $Total_margin = WonProject::whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get('total_margin');
           
            foreach($Total_margin as $t)
            {
                $sum = $sum + $t->total_margin;
            }
            $Total_invoice1= WonProject::whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::select('vendor_total')->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get()->toArray();
             $sum1 = 0 ;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
             $client_1= $Total_invoice;
            
             $vendor_1= $sum1;
          
           
           
            $client_Invoice_Value=WonProject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->sum('client_total');
            $Total_Margin_Value=WonProject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->sum('total_margin');
            $Total_Invoice_Value2=$client_1+$sum1;
            $Total_Invoice_Value= (int) $Total_Invoice_Value2;
            
            //new
            
            $client_t=Client::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $vendor_t=Vendor::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $Total_Rfq_Bid=BidRfq::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $RFQS_Bid=BidRfq::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $RFQS_Bid_count=$RFQS_Bid;
            $Total_Won_Projects=WonProject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            //end new
            $total_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('total_margin');
            $total_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('total_margin');
            $total_euro=WonProject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('total_margin');
            $total_pound=WonProject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('total_margin');
            $total_usd1= intval($total_usd);
            $total_inr1= intval($total_inr);
            $total_euro1= intval($total_euro);
            $total_pound1= intval($total_pound);
           // currency revenue
           $client_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('client_total');
            //   $client_balance_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('client_balance');
           $client_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('client_total');
           //   $client_balance_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('client_balance');
           $client_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('client_total');
           //   $client_balance_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('client_balance');
           $client_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('client_total');
          //   $client_balance_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('client_balance');

          $vendor_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->get();
      
          $vendor_sum1 = 0 ;
             for($i=0;$i<count($vendor_usd);$i++)
             {
             $vendor_revenue=explode(',',$vendor_usd[$i]['vendor_total']);
             $vendor_sum1 = $vendor_sum1 + array_sum($vendor_revenue);
              }
              
              $vendor_rev_usd=$vendor_sum1;
          //   $vendor_balance_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('vendor_balance');
          $vendor_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->get();
          $vendor_sum2 = 0 ;
             for($i=0;$i<count($vendor_inr);$i++)
             {
             $vendor_revenue2=explode(',',$vendor_inr[$i]['vendor_total']);
             $vendor_sum2 = $vendor_sum2 + array_sum($vendor_revenue2);
              }
              
              $vendor_rev_inr=$vendor_sum2;
              
         //   $vendor_balance_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('vendor_balance');
          $vendor_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->get();
      
         $vendor_sum3 = 0 ;
             for($i=0;$i<count($vendor_euro);$i++)
             {
             $vendor_revenue3=explode(',',$vendor_euro[$i]['vendor_total']);
             $vendor_sum3 = $vendor_sum3 + array_sum($vendor_revenue3);
              }
              
              $vendor_rev_euro=$vendor_sum3;
          //   $vendor_balance_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('vendor_balance');
         $vendor_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->get();
             $vendor_sum4 = 0 ;
             for($i=0;$i<count($vendor_pound);$i++)
             {
             $vendor_revenue4=explode(',',$vendor_pound[$i]['vendor_total']);
             $vendor_sum4 = $vendor_sum4 + array_sum($vendor_revenue4);
              }
              
              $vendor_rev_pound=$vendor_sum4;
         //   $vendor_balance_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('vendor_balance');
          $revenue_usd=intval($client_usd+$vendor_rev_usd);
          $revenue_inr=intval($client_inr+$vendor_rev_inr);
          $revenue_euro=intval($client_euro+$vendor_rev_euro);
          $revenue_pound=intval($client_pound+$vendor_rev_pound);
            }
            else{
            $userId=auth()->user()->id;
            $sum =0 ;
            $Total_margin = WonProject::where('user_id',$userId)->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get('total_margin');
           
            foreach($Total_margin as $t)
            {
                $sum = $sum + $t->total_margin;
            }
            $Total_invoice1= WonProject::where('user_id',$userId)->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->sum('client_total');
            $Total_invoice = (int) $Total_invoice1;
            $vendor_invoice_total=WonProject::where('user_id',$userId)->select('vendor_total')->whereDate('created_at','>=',$request->start_1)->whereDate('created_at','<=',$request->end_1)->get()->toArray();
             $sum1 = 0 ;
             for($i=0;$i<count($vendor_invoice_total);$i++)
             {
             $vendor=explode(',',$vendor_invoice_total[$i]['vendor_total']);
             $sum1 = $sum1 + array_sum($vendor);
              }
             $client_1= $Total_invoice;
            
             $vendor_1= $sum1;
          
           
           
            $client_Invoice_Value=WonProject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->sum('client_total');
            $Total_Margin_Value=WonProject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->sum('total_margin');
            $Total_Invoice_Value2=$client_1+$sum1;
            $Total_Invoice_Value= (int) $Total_Invoice_Value2;
            
            //new
            
            $client_t=Client::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $vendor_t=Vendor::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $Total_Rfq_Bid=BidRfq::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $RFQS_Bid=BidRfq::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            $RFQS_Bid_count=$RFQS_Bid;
            $Total_Won_Projects=WonProject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->count();
            //end new
            $total_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('total_margin');
            $total_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('total_margin');
            $total_euro=WonProject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('total_margin');
            $total_pound=WonProject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('total_margin');
            $total_usd1= intval($total_usd);
            $total_inr1= intval($total_inr);
            $total_euro1= intval($total_euro);
            $total_pound1= intval($total_pound);
           // currency revenue
           $client_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('client_total');
            //   $client_balance_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('client_balance');
           $client_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('client_total');
           //   $client_balance_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('client_balance');
           $client_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('client_total');
           //   $client_balance_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('client_balance');
           $client_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('client_total');
          //   $client_balance_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('client_balance');

          $vendor_usd=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->get();
      
          $vendor_sum1 = 0 ;
             for($i=0;$i<count($vendor_usd);$i++)
             {
             $vendor_revenue=explode(',',$vendor_usd[$i]['vendor_total']);
             $vendor_sum1 = $vendor_sum1 + array_sum($vendor_revenue);
              }
              
              $vendor_rev_usd=$vendor_sum1;
          //   $vendor_balance_usd=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','$')->sum('vendor_balance');
          $vendor_inr=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->get();
          $vendor_sum2 = 0 ;
             for($i=0;$i<count($vendor_inr);$i++)
             {
             $vendor_revenue2=explode(',',$vendor_inr[$i]['vendor_total']);
             $vendor_sum2 = $vendor_sum2 + array_sum($vendor_revenue2);
              }
              
              $vendor_rev_inr=$vendor_sum2;
              
         //   $vendor_balance_inr=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','₹')->sum('vendor_balance');
          $vendor_euro=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->get();
      
         $vendor_sum3 = 0 ;
             for($i=0;$i<count($vendor_euro);$i++)
             {
             $vendor_revenue3=explode(',',$vendor_euro[$i]['vendor_total']);
             $vendor_sum3 = $vendor_sum3 + array_sum($vendor_revenue3);
              }
              
              $vendor_rev_euro=$vendor_sum3;
          //   $vendor_balance_euro=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','€')->sum('vendor_balance');
         $vendor_pound=Wonproject::where('user_id',$userId)->wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->get();
             $vendor_sum4 = 0 ;
             for($i=0;$i<count($vendor_pound);$i++)
             {
             $vendor_revenue4=explode(',',$vendor_pound[$i]['vendor_total']);
             $vendor_sum4 = $vendor_sum4 + array_sum($vendor_revenue4);
              }
              
              $vendor_rev_pound=$vendor_sum4;
         //   $vendor_balance_pound=Wonproject::wheredate('created_at','>=',$request->start_1)->wheredate('created_at','<=',$request->end_1)->where('currency','£')->sum('vendor_balance');
          $revenue_usd=intval($client_usd+$vendor_rev_usd);
          $revenue_inr=intval($client_inr+$vendor_rev_inr);
          $revenue_euro=intval($client_euro+$vendor_rev_euro);
          $revenue_pound=intval($client_pound+$vendor_rev_pound);
            }
          }
        
        
        
        
        
        return response()->json(['client_t'=>$client_t,'vendor_t'=>$vendor_t,'Total_Rfq_Bid'=> $Total_Rfq_Bid,'Total_Won_Projects'=>$Total_Won_Projects,"Total_margin"=>$Total_margin,'Total_Invoice_Value'=>$Total_Invoice_Value,'Total_Margin_Value'=>$Total_Margin_Value,"client_1"=>$client_1,"vendor_1"=>$vendor_1,"won_project_count"=>$RFQS_Bid_count,"RFQS_Bid_count"=>$RFQS_Bid_count,"lost"=>$lost,"won"=>$won,"next"=>$next,"sum"=>$sum,"total_usd"=>$total_usd1,"total_inr"=>$total_inr1,"total_euro"=>$total_euro1,"total_pound"=>$total_pound1,"revenue_usd"=>$revenue_usd,"revenue_inr"=>$revenue_inr,"revenue_euro"=>$revenue_euro,"revenue_pound"=>$revenue_pound]);   
    
         

    }
}
