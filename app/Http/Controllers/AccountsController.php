<?php

namespace App\Http\Controllers;
use App\Models\OperationNew;
use App\Models\Clientrequest;
use App\Models\Country;
use App\Models\Client;
use App\Models\BidRfq;
use App\Models\Vendor;
use App\Models\Fieldteam;
use App\Models\WonProject;
use App\Models\clientrequestbalance;
use App\Models\Vendorrequestadvance;
use App\Models\Vendorrequestbalance;
use App\Models\Clientpayment;
use App\Models\VendorPayment;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class AccountsController extends Controller
{
    public function overview(){
        return view('accountsdashboard');
    }
    public function clientrequest(){
        return view('accounts.client_invoice_request');
    }
    public function clientrequest1(Request $request){
        $data=$request->all();
        $clientrequest=Clientrequest::with('operation')->where('status','pending');
        if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
            //  $clientrequest->wherehas('operation',function($q) use ($data){
                 if(($data['startdate'] == $data['enddate'])){
                      $clientrequest->whereDate('created_at','=',$data['startdate']);
                 }else{
                     $clientrequest->whereDate('created_at','>=',$data['startdate'])->whereDate('created_at','<=',$data['enddate']);
                 }
            //  });
        }
        if(isset($data['invoice_type']) && $data['invoice_type']!=''){
            $clientrequest->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
        if(isset($data['purchase_order_no'])!='' && $data['purchase_order_no']!=''){
            $clientrequest->wherehas('operation',function ($q) use ($data){
            $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
        });
    }
        if(isset($data['project_no'])!='' && $data['project_no']!=''){
            $clientrequest->wherehas('operation',function($q) use ($data){
                $q->where('project_no','like','%'.$data['project_no'].'%');
            });
                
        }
        if(isset($data['client_id'])!='' && $data['client_id']!=''){
            $clientrequest->wherehas('operation',function($q) use ($data){
                $q->where('client_id','like','%'.$data['client_id'].'%');
            });
                
        }
    
        //  dd($clientrequest);
            return Datatables::of($clientrequest->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
    }

    // public function clientrequest(){
    //     $clientrequest=OperationNew::join('client_advance_request','operation_new.id','=','client_advance_request.operation_id')->where('client_advance_request.status','pending')->get();
    //     $clientrequest1=OperationNew::join('client_balance_request','operation_new.id','=','client_balance_request.operation_id')->get(); 
    //     return view('accounts.client_invoice_request',compact('clientrequest','clientrequest1'));
    // }

    public function Vendorrequestadvance(){
        // $vendorrequestadvance=OperationNew::join('vendor_request_advance','operation_new.id','=','vendor_request_advance.operation_id')->where('vendor_request_advance.status','pending')->get();
        // $vendorrequestbalance=OperationNew::join('vendor_request_balance','operation_new.id','=','vendor_request_balance.operation_id')->where('vendor_request_balance.status','pending')->get();
        return view('accounts.vendor_invoice_request');
    }


  
      public function Vendorrequestadvance1(Request $request){
        $data=$request->all();
        $vendorquest=Vendorrequestadvance::where('status','pending')->with('operation');
        if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
                 if(($data['startdate'] == $data['enddate'])){
                       $vendorquest->whereDate('updated_at','=',$data['startdate']);
            }else{
               $vendorquest->whereDate('updated_at','>=',$data['startdate'])->whereDate('updated_at','<=',$data['enddate']);  
            }
           
        }
         if(isset($data['invoice_type']) && $data['invoice_type']!=''){
            $vendorquest->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
        if(isset($data['purchase_order_no'])!='' && $data['purchase_order_no']!=''){
            $vendorquest->wherehas('operation',function ($q) use ($data){
            $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
        });
    }
        if(isset($data['project_no'])!='' && $data['project_no']!=''){
            $vendorquest->wherehas('operation',function($q) use ($data){
                $q->where('project_no','like','%'.$data['project_no'].'%');
            });
                
        }
         if(isset($data['vendor_id'])!='' && $data['vendor_id']!=''){
            $vendorquest->wherehas('operation',function($q) use ($data){
                $q->where('vendor_id','like','%'.$data['vendor_id'].'%');
            });
                
        }
    
            return Datatables::of($vendorquest->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
    }





    // payment awaited

    public function getpayment(Request $request){
      

        return view('accounts.paymentawaited');
    }
    public function awite(){
        
    }
    public function getpayment1(Request $request){
        
        // dd($request->all());
        $data=$request->all();
       

        $awite=OperationNew::join('client_advance_request','operation_new.id','=','client_advance_request.operation_id')->where('client_advance_request.status','awaited');
        
        if((isset($data['startdate']) && $data['startdate']!='') && (isset($data['enddate']) && $data['enddate']!='') ){
             if(($data['startdate'] == $data['enddate'])){
                 
                 $awite->whereDate('client_advance_request.updated_at','=',$data['startdate']);
             }
             else{
                 $awite->whereDate('client_advance_request.updated_at','>=',$data['startdate'])->whereDate('client_advance_request.updated_at','<=',$data['enddate']);
             }
          
        }
         if(isset($data['invoice_type']) && $data['invoice_type']!=''){
             $awite->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
        
        if(isset($data['client_id'])!='' && $data['client_id']!=''){
                $awite->where('client_advance_request.client_id','like','%'.$data['client_id'].'%');
                
        }
        
        
      
        
       
            return Datatables::of($awite->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
       

    }
   


    // payment awaited


    public function clientview($id, OperationNew $operation){
        $bidrfq = BidRfq ::get();
        $country = Country::get();
        $vendor = Vendor::get();
        $fieldteam=Fieldteam::get();
        $user=User::where('user_role','team_leader')->get();
        $user1=User::where('user_role','project_manager')->get();
        $user2=User::where('user_role','quality_analyst')->get();
        $user3 = Auth::user();
        $clientrequest=Clientrequest::find($id);
        $client = Client::get();
        $wonproject = WonProject::where('rfq_no', $clientrequest->rfq)->first();
        $rfq= WonProject::where('rfq_no', $clientrequest->rfq)->select('rfq_no')->first();
        $rfq_no=str_replace('{"rfq_no":"','', $rfq);
        $rfq_no1=str_replace('"}','',$rfq_no);
        $rfq1=explode('_',$rfq_no1);
        $bid=$rfq1[0];
        $bidrfq = BidRfq::where('rfq_no', $bid)->first();
        // dd($rfq_no);
        return view('accounts.client_advance_view',compact('clientrequest','wonproject','bidrfq','client','vendor','country','id','operation','country','fieldteam','user','user1','user2','user3'));
    }


    public function clientsent(Request $req){
        $response_data=[];
         $validator = Validator::make($req->all(),
         [
             'id'=>'required',
         ]
             );
 
         if(!$validator->fails()){
             $clientadvance=Clientrequest::where('id',$req->id)
                             ->update(['status'=>'awaited']);
            if( $clientadvance){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>0 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
     }

     public function clientview1($data){
       
        $clientrequest1=clientrequestbalance::find($data);
        return view('accounts.client_balance_view',compact('clientrequest1'));
    }

    public function clientsent1(Request $req){
        $response_data=[];
         $validator = Validator::make($req->all(),
         [
             'id'=>'required',
         ]
             );
 
         if(!$validator->fails()){
             $clientbalance=Clientrequestbalance::where('id',$req->id)
                             ->update(['status'=>'awaited']);
            if( $clientbalance){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>0 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
     }
     
     public function clientpendingview($id){
        $clientrequest=Clientrequest::find($id);                     
        return view('accounts.client_pending_view',compact('clientrequest'));
    }
    public function getreceivedview($id){
        $clientreceived=Clientpayment::find($id);
        $client1=Clientpayment::find($id)->client;
        $clientoperation=Clientpayment::find($id)->client->operation;
        return view('accounts.client_received',compact('clientreceived','client1','clientoperation'));
    }
   
    
    




// vendor accounts
    public function vendoradvanceview($id){
        $vendoradvance=Vendorrequestadvance::find($id);                     
        return view('accounts.vendor_advance_view',compact('vendoradvance'));
    }
    
    public function vendorpendingview($id){
        $vendoradvance=Vendorrequestadvance::find($id);                     
        return view('accounts.vendorpendingview',compact('vendoradvance'));
    }
      public function receivedview($id){
        $vendorreceived=VendorPayment::find($id);
        $vendorclient=VendorPayment::find($id)->client;
        $vendoroperation=VendorPayment::find($id)->client->operation;
        // dd($vendorreceived);
        return view('accounts.vendor_received_view',compact('vendorreceived','vendorclient','vendoroperation'));
    }
    
    
    public function advancesent(Request $req){
        $response_data=[];
         $validator = Validator::make($req->all(),
         [
             'id'=>'required',
         ]
             );
 
         if(!$validator->fails()){
             $clientadvance=Vendorrequestadvance::where('id',$req->id)
                             ->update(['status'=>'awaited']);
            if( $clientadvance){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>0 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
 
        
         
 
     }
    
    public function vendorview($id){
        $vendorbalance=Vendorrequestbalance::find($id);                     
        return view('accounts.vendor_balance_view',compact('vendorbalance'));
    }
    public function sent1(Request $req){
        $response_data=[];
         $validator = Validator::make($req->all(),
         [
             'id'=>'required',
         ]
             );
 
         if(!$validator->fails()){
             $vendoradvance=Vendorrequestadvance::where('id',$req->id)
                             ->update(['status'=>'awaited']);
            if( $vendoradvance){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>0 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
     }
   //end vendor accounts



//    client paid
   public function awitview($id, OperationNew $operation){
       $clientrequest=Clientrequest::find($id);
       return view('accounts.client_awit_view',compact('clientrequest'));

   } 

   public function clientpaid(Request $req){
    $response_data=[];
    $validator = Validator::make($req->all(),
    [
        'id'=>'required',
    ]
        );

    if(!$validator->fails()){
        $clientadvance=Clientrequest::where('id',$req->id)
                        ->update(['status'=>'paid']);
       if( $clientadvance->save()){
           $response_data=["success"=>1 ,"message"=>"data saved success"];
       }
       else{
        $response_data=["success"=>0 ,"message"=>"data  not saved "];
       }
    }
    else{
        $response_data=["success"=>0 ,"message"=>" not found "];
    } 
    return response()->json($response_data);

   }
   public function paidstore(Request $req){
       $validator=Validator::make($req->all(),
       [
        'transaction_number'=>'required',
        'date_payment'=>'required',
        'bank_name'=>'required',
        'firc'=>'required'
       ]);

       if(!$validator->fails()){
           $clientpaid=new Clientpayment();
           $clientpaid->transaction_number=$req->transaction_number;
           $clientpaid->date_payment=$req->date_payment;
           $clientpaid->bank_name=$req->bank_name;	
           $clientpaid->upload_invoice=$req->upload_invoice;	
           $clientpaid->advance_id=$req->advance_id;
            if ($req->hasFile('firc'))
                {
                    $file = $req->file('firc');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/firccopy', $filename);
                    $clientpaid->firccopy= 'global_assets/firccopy/' . $filename;
                }
           if($clientpaid->save()){
               $response_data=["success"=>1,"message"=>"received update successfully"];
           }
           else{
              $response_data=["success"=>0,"message"=>"received update  unsuccessfully"];
           }
           
       }
       else{
           $response_data=["success"=>0,"message"=>"not found"];
       }
       return response()->json($response_data);
   }

   public function paymentreceived(Request $request){
   
    return view('accounts.client_received_view');

   }
   public function paymentreceived1(Request $request){
    $data=$request->all();
    
    $clientpaid = Clientpayment::with('client','client.operation');
    if((isset($data['startdate']) && $data['startdate']!='') && (isset($data['enddate']) && $data['enddate']!='') ){
            if(($data['startdate'] == $data['enddate']))
            {
             $clientpaid->whereDate('created_at','=',$data['startdate']);
            }
            else
            {
             $clientpaid->whereDate('created_at','>=',$data['startdate'])->whereDate('created_at','<=',$data['enddate']);
            }  
        }
    if(isset($data['invoice_type'])!='' && $data['invoice_type']!=''){
        $clientpaid->wherehas('client',function ($q) use ($data){
        $q->where('invoice_type','like','%'.$data['invoice_type'].'%');
    });
}
    if(isset($data['purchase_order_no'])!='' && $data['purchase_order_no']!=''){
        $clientpaid->wherehas('client.operation',function ($q) use ($data){
        $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
    });
}
    if(isset($data['project_no'])!='' && $data['project_no']!=''){
        $clientpaid->wherehas('client.operation',function($q) use ($data){
            $q->where('project_no','like','%'.$data['project_no'].'%');
        });
            
    }
    if(isset($data['client_id'])!='' && $data['client_id']!=''){
            $clientpaid->wherehas('client.operation',function($q) use ($data){
                $q->where('client_id','like','%'.$data['client_id'].'%');
            });
                
        }

        return Datatables::of($clientpaid->get())
       
                ->addIndexColumn()
            
                ->rawColumns(['action'])
                ->make(true);
   }

   public function clientpending(Request $request){
    return view('accounts.client_pending');

   }
   public function clientpending1(Request $request){
    $data=$request->all();
    
    $pending=Clientrequest::where('status','pending')->with('operation');
    if(isset($data['startdate']) && $data['startdate']!='' && ($data['enddate']) && $data['enddate']!=''){
          if(($data['startdate'] == $data['enddate'])){
                    //  dd("hi");
                      $pending->whereDate('updated_at','=',$data['startdate']);
                 }else{
                $pending->whereDate('updated_at','>=',$data['startdate'])->whereDate('updated_at','<=',$data['enddate']);
                 }
    }
    if(isset($data['invoice_type']) && $data['invoice_type']!=''){
            $pending->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
    if(isset($data['purchase_order_no'])!='' && $data['purchase_order_no']!=''){
        $pending->wherehas('operation',function ($q) use ($data){
        $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
    });
}
    if(isset($data['project_no'])!='' && $data['project_no']!=''){
        $pending->wherehas('operation',function($q) use ($data){
            $q->where('project_no','like','%'.$data['project_no'].'%');
        });
            
    }
    if(isset($data['client_id'])!='' && $data['client_id']!=''){
           $pending->wherehas('operation',function($q) use ($data){
                $q->where('client_id','like','%'.$data['client_id'].'%');
            });
                
        }

        return Datatables::of($pending->get())
       
                ->addIndexColumn()
            
                ->rawColumns(['action'])
                ->make(true);
    

   }

    
    
     public function getvendorpayment(Request $request){
        $data=$request->all();
        $awite=OperationNew::join('vendor_request_advance','operation_new.id','=','vendor_request_advance.operation_id')->where('vendor_request_advance.status','awaited');
        if((isset($data['startdate']) && $data['startdate']!='') && (isset($data['enddate']) && $data['enddate']!='') ){
            if(($data['startdate'] == $data['enddate'])){
                $awite->whereDate('vendor_request_advance.updated_at','=',$data['startdate']);
                // dd($awite);
                 }else{
                $awite->whereDate('vendor_request_advance.updated_at','>=',$data['startdate'])->whereDate('vendor_request_advance.updated_at','<=',$data['enddate']);
                 }  
        }
        if((isset($data['invoice_type']) && $data['invoice_type']!='') ){
          $awite->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
        
        // dd($clientrequest);
     if ($request->ajax()) {
            return Datatables::of($awite->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('accounts.vendorpaymentawaited',compact('awite'));
    }
    
    
    public function awaitview($cid){
       $vendorrequestadvance=Vendorrequestadvance::find($cid);
       return view('accounts.vendor_advan_awit_view',compact('vendorrequestadvance'));

   }
   
   
    public function vendorpaid(Request $req){
        // dd($req->all());
       $v = $req->all();
        
       $validator = Validator::make(
            $v,
            []
        );


        if (!$validator->fails()) {

            $operation = Vendorrequestadvance::where('id',$req->vendor_id)->update(['status' => 'paid']);

            $vendorpay = new VendorPayment();
           
            
            $vendorpay->vendor_id = $req->vendor_id;
            $vendorpay->transaction_number = $req->transaction_number;
            $vendorpay->payment_date = $req->date_payment;
            $vendorpay->bank_name = $req->bank_name;
            $vendorpay->upload_invoice = $req->upload_invoice;
            if ($req->hasFile('swift'))
                {
                    $file = $req->file('swift');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/swiftcopy', $filename);
                    $vendorpay->swift= 'global_assets/swiftcopy/' . $filename;
                }
            
            if ($vendorpay->save()) {
                $response_data = ["success" => 1, "message" => "Payment Received Successfully"];

            } else {
                $response_data = ["success" => 0, "message" => "Payment Received Failed"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }


      public function vendorreceived(Request $request){
      
        return view('accounts.vendorreceivedpayments');
    }

    
    public function vendorreceived1(Request $request){
      
        $data=$request->all();
        // $awite=OperationNew::join('vendor_request_advance','operation_new.id','=','vendor_request_advance.operation_id')->where('vendor_request_advance.status','awaited')->get();
        $vendorpaid = VendorPayment::with('client','client.operation');
        if((isset($data['start_date']) && $data['start_date']!='') && (isset($data['end_date']) && $data['end_date']!='') ){
            if(($data['start_date'] == $data['end_date']))
            {
             $vendorpaid->whereDate('created_at','=',$data['start_date']);
            }
            else
            {
             $vendorpaid->whereDate('created_at','>=',$data['start_date'])->whereDate('created_at','<=',$data['end_date']);
            }  
        }
        if(isset($data['purchase_order_no']) && $data['purchase_order_no']!=''){
            $vendorpaid->whereHas('client.operation', function( $q) use($data){
                $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
            });
        }
        if(isset($data['invoice_type']) && $data['invoice_type']!=''){
            $vendorpaid->whereHas('client.operation', function( $q) use($data){
                $q->where('invoice_type','like','%'.$data['invoice_type'].'%');
            });
           
        }
        
        if(isset($data['project_no']) && $data['project_no']!=''){
            $vendorpaid->whereHas('client.operation', function( $q) use($data){
                $q->where('project_no','like','%'.$data['project_no'].'%');
            });
           
        }
        
        if(isset($data['vendor_id'])&& $data['vendor_id']!= ''){
            
            $vendorpaid->whereHas('client', function( $q) use($data){
                $q->where('vendor_id','like','%'.$data['vendor_id'].'%');
            });
            
            // $vendorpaid->where('client.vendor_id','like','%'.$data['vendor_id'].'%');
        }
       
        

            return Datatables::of($vendorpaid->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
        
      
    }



     public function vendorpending(Request $request){
        $data=$request->all();

        
        $vendorrequestadvance=Vendorrequestadvance::where('status','pending')->with('operation'); 
        
        if(isset($data['start_date']) && $data['start_date']!='' && ($data['end_date']) && $data['end_date']!=''){
             if(($data['start_date'] == $data['end_date'])){
             $vendorrequestadvance->whereDate('created_at','=',$data['start_date']);
                 }else{
             $vendorrequestadvance->whereDate('created_at','>=',$data['start_date'])->whereDate('created_at','<=',$data['end_date']);
                 }  
        }
         if(isset($data['invoice_type']) && $data['invoice_type']!=''){
            $vendorrequestadvance->where('invoice_type','like','%'.$data['invoice_type'].'%');
        }
        if(isset($data['purchase_order_no'])!='' && $data['purchase_order_no']!=''){
            $vendorrequestadvance->wherehas('operation',function ($q) use ($data){
            $q->where('purchase_order_no','like','%'.$data['purchase_order_no'].'%');
        });
    }
        if(isset($data['project_no'])!='' && $data['project_no']!=''){
            $vendorrequestadvance->wherehas('operation',function($q) use ($data){
                $q->where('project_no','like','%'.$data['project_no'].'%');
            });
                
        }
         if(isset($data['vendor_id'])!='' && $data['vendor_id']!=''){
            $vendorrequestadvance->wherehas('operation',function($q) use ($data){
                $q->where('vendor_id','like','%'.$data['vendor_id'].'%');
            });
                
        }
        
     if ($request->ajax()) {
            return Datatables::of($vendorrequestadvance->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('accounts.vendor_pending_invoice',compact('vendorrequestadvance'));
        
    }
    
    
    public function getfircopy(Request $req){
       $v = $req->all();
       $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if(!$validator->fails()){
          $clientpay =Clientpayment::where('id', $req->id)->update(['firccopy'=>$req->firccopy]);
          if ($clientpay) {
                    $response_data = ["success" => 1, "message" => "Updated Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
            
        }
        
    public function getswift(Request $req){
       $v = $req->all();
       $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if(!$validator->fails()){
          $vendorpay = VendorPayment::where('id', $req->id)->update(['swift'=>$req->swift]);
          if ($vendorpay) {
                    $response_data = ["success" => 1, "message" => "Updated Successfully"];
                } else {
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
            
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
    
        return response()->json($response_data);
            
        }
        
    
    public function uploadinvoicestore(Request $req){
        
     $validator=Validator::make($req->all(),
       [
        'upload_invoice'=>'required',
        'id'=>'required',
       ]);

       if(!$validator->fails()){
             $clientadvance=Clientrequest::where('id',$req->id)->first();
              if ($req->hasFile('upload_invoice'))
                {
                    $file = $req->file('upload_invoice');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/upload_invoice', $filename);
                    $clientadvance->upload_invoice= 'global_assets/upload_invoice/' . $filename;
                }
                 $clientadvance->status='awaited';
                
            if( $clientadvance->update()){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>2 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
     }
    
    public function vendoruploadinvoicestore(Request $req){
     $validator=Validator::make($req->all(),
       [
        'upload_invoice'=>'required',
        'id'=>'required',
       ]);

       if(!$validator->fails()){
             $vendoradvance=Vendorrequestadvance::where('id',$req->id)->first();
              if ($req->hasFile('upload_invoice'))
                {
                    $file = $req->file('upload_invoice');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('global_assets/vendor_upload_invoice', $filename);
                    $vendoradvance->upload_invoice= 'global_assets/vendor_upload_invoice/' . $filename;
                }
                 $vendoradvance->status='awaited';
                
            if( $vendoradvance->update()){
                $response_data=["success"=>1 ,"message"=>"data saved success"];
            }
            else{
             $response_data=["success"=>0 ,"message"=>"data  not saved "];
            }
         }
         else{
             $response_data=["success"=>2 ,"message"=>" not found "];
         } 
         return response()->json($response_data);
     }
     
     public function perfomance(){
         $user_name=User::where('user_type','accounts')->get();
         return view('accounts.perfomance',compact('user_name'));
     }
    public function getperfomance(Request $request){
        $client_pending=Clientrequest::where('user_id',$request->id)->get();
    }
    }

    


