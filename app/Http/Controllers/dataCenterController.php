<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\datacenternew;
use Illuminate\Support\Facades\Validator;
use App\Events\SendInviteMail;
use App\Events\SendMail;
use App\Events\SendDoctorMail;
use App\Events\SendDoctorpnoMail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\sendverification;
use Illuminate\Support\Facades\Mail;
    use App\Models\User;
use App\Models\Speciality;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Sendmoney;
use Illuminate\Support\Facades\Auth;
use App\Models\adminvoucher;
use App\Models\adminMoneysend;
use App\Models\accountregister;
use App\Models\Doctornotification;
use Carbon\Carbon;
use App\Models\doctor_pno;
use App\Exports\DoctorExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App;
use App\Events\question_email;
use App\Models\Choices;
use App\Models\Questions;
use App\Models\Que;
use Exception;
use Config;
use App\Events\SendpopinviteMail;
// use Barryvdh\DomPDF\Facade\PDF;
use PDF;

class dataCenterController extends Controller
{
    public function DataNew(Request $req)
    {
        $country=Country::get();
      
        $speciality=Speciality::get();
         $unique_no = datacenternew::orderBy('id', 'DESC')->with('pno_no','pno_no')->pluck('id')->first();
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
        return view('DataCenter.newRegistration', compact('country','pno_no','speciality'));
    }
    public function invite(Request $req){
        return view('DataCenter.invite');
    }
    public function invite1(Request $req){
        
        $validator = Validator::make(
            $req->all(),
            [
                'email'=>'required|email',
                ]
        );
        $link='arp.stagingzar.com/newdoctorregister';
        event(new SendInviteMail ([$req->email,$link]));

    }

    public function popinvite(Request $req){
        return view('DataCenter.popinvite');
    }
      public function popinvite1(Request $req){
        
        $validator = Validator::make(
            $req->all(),
            [
                'email'=>'required|email',
                ]
        );
        $user_id = Auth::user()->id;
       
        

        // dd($link);
       


        event(new SendpopinviteMail ([$req->email,$user_id]));
        $response_data=["success"=>1,"message"=>"Mail Send Successfully" ];
        return response()->json($response_data);
    }
    public function OutsideDataNew(Request $req)
    {
        $speciality=Speciality::get();
        $country_loop_1=Country::get();
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
        return view('DataCenter.outsitenewRegistration', compact('country_loop_1','speciality','pno_no'));
    }
    
    public function NewForm(Request $req)
    {
        $v = $req->all();
        // dd($v);
        $response_data = [];
        $validator = Validator::make(
            $v,
            [
                'email'=>'required|email|unique:datacenternews,email',
                ]
        );

        if (!$validator->fails()) {
            $random_no=uniqid();
            $create = new User();
            
            $create->name = $req->firstname;
            $create->email = $req->email;
            $create->user_type = 'doctor';
            $create->user_role = 'doctor';
            $create->password = Hash::make($random_no);
            if($create->save())
                {
                    //dd($create->id);
                $new = new datacenternew();
                $new->pno = $req->pno;
                $encrypted = Crypt::encryptString($req->email);
                
                // dd($random_no);
                // dd( $encrypted);
                $new->token= $encrypted;
                // dd($new);
                $new->password =$random_no;
                // dd($new->password);
                $new->firstname = $req->firstname;
                // dd($new);
                $new->lastname = $req->lastname;
                $new->cityname = $req->Cityname;
                $new->citycode = $req->Citycode;
                $new->PhNumber = $req->PhoneNumber;
                
                $new->email = $req->email;
                $new->whatdsappNumber = $req->whatsappNumber;   
                $new->docterSpeciality = $req->docterSpeciality;
                $new->totalExperience = $req->Experience;
                $new->practice = $req->Practice;
                $new->user_id = $create->id;
                $new->licence = $req->licenceNumber;
                $new->PatientsMonth = $req->permonth;
                $new->country1=$req->country1;
                
                $new->datacenter_id=Auth()->user()->id;

                if ($req->hasFile('file'))
                {
                    $file = $req->file('file');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' .$extension;
                    $file->move('datacenter/doctor_file', $filename);
                    $new->document = 'datacenter/doctor_file/' . $filename;
                }

               
                if ($new->save()) {
                    
                        event(new SendMail([$req->email,$encrypted,$new->password]));
                       $response_data=["success"=>1,"message"=>"register Success"];
                } else {
                    $response_data=["success"=>0,"message"=>"register fail"];
                }
                
            }
        }
            else{
            $response_data=["success"=>2,"message"=>"validation error" ,"errors" => $validator->errors()];
           }

        
        return response()->json($response_data);
    }
   
    public function useractived($id){
      
        $emaildata=datacenternew::where('token',$id)->select('token', 'email', 'firstname','id','password')->first();
       
       $data=datacenternew::where('token',$id)->update(['Membershipstatus'=>1]);
       
       Mail::to($emaildata->email)->send(new sendverification($emaildata));  
      
     
       if($data){
                $notification= new Doctornotification();
                $notification->doctor_id = $emaildata->id;
                $notification->user_type = 'doctor';
                $notification->message_type = 'reg';
                $notification->status = '0';
                $notification->send_id = $emaildata->id;
                 if($notification->save()){
                        $response_data=["success" => 1, "message" => "Notification Successfully"];
                      }
                      else{
                       $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                      }
                
       }
       else{
            $response_data=["success" => 0, "message" => "error unSuccessfully"];
           
       }

    

       return view('DataCenter.registersuccess',compact('emaildata'));
  

    }
     public function user_actived1($id){
      
        $emaildata=Que::where('token',$id)->select('token', 'email', 'fname','id','password')->first();
       
       $data=Que::where('token',$id)->update(['Membershipstatus'=>1]);
       
       Mail::to($emaildata->email)->send(new sendverification($emaildata));  
      
       return view('DataCenter.registersuccess',compact('emaildata'));
  

    }
    public function docterEdit(){
        // dd("hi");
        return view('Datacenter.docterEdit');
    }
    public function docterfech(){
        dd("hi");
    }
    

    public function editdata(Request $req){
        $docterEdit=datacenternew::where('id',$req->docter_id)->first();
        $docterEdit->firstname=$req->first;
        $docterEdit->lastname=$req->last;
        $docterEdit->cityname=$req->city;
        $docterEdit->citycode=$req->code;   
        $docterEdit->PhNumber=$req->phone;
        $docterEdit->whatdsappNumber=$req->whatsapp;	
        $docterEdit->docterSpeciality=$req->docterSpeciality;	
        $docterEdit->totalExperience=$req->Experience;
        $docterEdit->practice=$req->Practice;
        $docterEdit->licence=$req->licence;
        $docterEdit->PatientsMonth=$req->patient;
        $docterEdit->country1=$req->country;
        if ($req->hasFile('document'))
                {
                    $file = $req->file('document');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.document.' .$extension;
                    $file->move('datacenter/doctor_file', $filename);
                    $docterEdit->document = 'datacenter/doctor_file/' . $filename;
                }
                if ($req->hasFile('image'))
                {
                    $file = $req->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.image.' .$extension;
                    $file->move('datacenter/docter_file', $filename);
                    $docterEdit->profile_image = 'datacenter/docter_file/' . $filename;
                }       
                
                if($docterEdit->save()){
                    $response_data = ["success" => 1, "message" => "Docter Edit Successfully","data" => $docterEdit];
                }else{
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }

                return response()->json($response_data);
    }
    

    public function adminDatatable(Request $request){
        $speciality=Speciality::get();
        return view('DataCenter.adminview',compact('speciality'));
    }
    public function adminDatatable1 (Request $request){
        $data=$request->all();
         $doctor=datacenternew::latest();
         if(isset($data['speciality']) && $data['speciality']!=''){
            $doctor->where('docterSpeciality','like','%'.$data['speciality'].'%');
        }
        if(isset($data['pno']) && $data['pno']!=''){
            $doctor->where('pno','like','%'.$data['pno'].'%');
        }
        
        if(isset($data['fname']) && $data ['fname'] !=''){
             $doctor->where('firstname','like','%'.$data['fname'].'%');
        }
        
        if(isset($data['lname']) && $data ['lname'] !=''){
             $doctor->where('lastname','like','%'.$data['lname'].'%');
        }
        
        

        if ($request->ajax()) {

            return Datatables::of($doctor->get())            
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                       
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true);
                    
        }
    } 
    public function sendmoney($id){
   
        $moneyoption=datacenternew::where('id',$id)->first();
        // dd($moneyoption);
        return view('DataCenter.moneyoption',compact('moneyoption'));
    }
    public function sendmoneyadmin(Request $req){
        $v = $req->all();
        // dd($v);
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if (!$validator->fails()) {
            $sendmoney = new Sendmoney();
            $sendmoney->money=$req->money;
            $sendmoney->docter_id=$req->docter_id;
            $sendmoney->status='pending';
            $sendmoney->user_id=$req->user_id;
            $sendmoney->voucher_code=$req->voucher_code;
            $sendmoney->user_name=$req->User_name;

            if($sendmoney->save()){
              if($sendmoney->save()){

                $response_data = ["success" => 1, "message" => "Docter Edit Successfully","data" => $sendmoney];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            return response()->json($response_data);  
                $response_data = ["success" => 1, "message" => "Docter Edit Successfully","data" => $sendmoney];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            return response()->json($response_data);
        }
    }
        public function receiveMoney(Request $req){
            // $user = Auth::user();

            // $receiveMoney=Sendmoney::where('user_id','=',Auth::user()->id)->where('status','pending')->get();
            
            $Docter_receiveMoney=adminMoneysend::where('user_id','=',Auth::user()->id)->where('status','Pending')->get();
            // dd($Docter_receiveMoney);

            // return view('DataCenter.ReceiveMoney',compact('receiveMoney'));
            // compact('Docter_receiveMoney'))
            
            return view('DataCenter.ReceiveMoney');
        }
        public function receiveMoney1(Request $request){
            $data=$request->all();
             $Docter_receiveMoney=adminMoneysend::where('user_id','=',Auth::user()->id)->where('status','Money Sent')->orderBy('id','Desc')->get();
            //  dd($Docter_receiveMoney);
             
             if ($request->ajax()) {
                
                 return Datatables::of($Docter_receiveMoney)           
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                       
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true); 
                
             }
            
        }
        public function redeemValue(Request $req){
            $sendmoney = adminMoneysend::with('user')->where('id',$req->id)->first();
            $sendmoney->status ='Pending';
            if($sendmoney->save()){
                $notification= Doctornotification::where('send_id',$sendmoney->id)->where('message_type','money')->first();
                 if($notification->status == 0){
                     $notification->update(['status'=>'2']);
                      if($notification){
                        $response_data=["success" => 1, "message" => "Notification Successfully"];
                      }
                     else{
                       $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                     }
                 }
                 elseif($notification->status == 1){
                     $notification->update(['status'=>'2']);
                      if($notification){
                        $response_data=["success" => 1, "message" => "Notification Successfully"];
                      }
                      else{
                       $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                      }
                 }
                 else{
                      $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                 }
            $response_data = ["success" => 1, "message" => "Docter Edit Successfully","sendmoney" => $sendmoney];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            return response()->json($response_data);
        }
        public function noredeemValue(Request $req){
             $sendmoney = adminMoneysend::with('user')->where('id',$req->id)->first();
             $sendmoney->status ='stop';
            if($sendmoney->save()){
                $response_data=["success" => 1, "message" => "Notification Successfully"];
            }
            else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            
            return response()->json($response_data);
        }
        
        
        public function receivevoucher(){
            // dd("hi");
            // dd(Auth::user()->id);
            // dd($Docter_receiveVoucher);
            return view('DataCenter.receivevoucher');
        }
        
        // public function reddemAcept(){
        //     // dd("hi");
        //     $redeemAccepted = Sendmoney::with('datacenternew')->where('status','activated')->get();
        //     // dd($redeemAccepted);
        //     return view('DataCenter.redeemaccepted',compact('redeemAccepted'));
        // }
        public function receivevoucher1(Request $request){
              $data=$request->all();
            //   dd($data);
          $Docter_receiveVoucher=adminvoucher::where('user_id','=',Auth::user()->id)->where('status','pending')->orderBy('id','Desc')->get();
        //   dd($Docter_receiveVoucher);
        
        if ($request->ajax()) {
                
                 return Datatables::of($Docter_receiveVoucher)           
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                       
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true); 
                
             }
        }
        
        public function doctorlist(Request $request){
        
            // $data = datacenternew::latest()->get();
    
            // if ($request->ajax()) {
            //     return Datatables::of($data)->addIndexColumn()
            //         ->addColumn('action', function ($row) {
            //         })
            //         ->rawColumns(['action'])
            //         ->make(true);
            // }
            $speciality=Speciality::get();
            return view('doctor.doctor_list', compact('speciality'));
            
        }
        public function doctorfilder(Request $request){
           
            $data=$request->all();
             $docter_filter = datacenternew::latest();

             if(isset($data['pno']) && $data['pno']!=''){
                $docter_filter->where('pno','like','%'.$data['pno'].'%');
            }
            if(isset($data['docterSpeciality']) && $data['docterSpeciality']!=''){
                $docter_filter->where('docterSpeciality','like','%'.$data['docterSpeciality'].'%');
            }
             if ($request->ajax()) {
                return Datatables::of($docter_filter->get())->addIndexColumn()
                    ->addColumn('action', function ($row) {
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        
        public function accountRegistration(){
            $user_id=datacenternew::where('user_id','=',Auth::user()->id)->first();
            // dd($user_id);
            return view('DataCenter.accountRegistration',compact('user_id'));
        }
        public function accountRegisterForm(Request $req){
            // dd($req->all());
           $accountRegister =new accountregister;
           $accountRegister->user_name=$req->user_name;
           $accountRegister->account_holder_name=$req->account_holder_name;
           $accountRegister->account_number =$req->account_number;
           $accountRegister->ifc_code=$req->ifc_code;
           $accountRegister->branch_name=$req->branch_name;
           $accountRegister->bank_name=$req->bank_name;
           if($accountRegister->save()){
            $response_data = ["success" => 1, "message" => "Docter Edit Successfully","accountRegister" => $accountRegister];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            return response()->json($response_data);
        }
        //admin
        public function MoneySend( Request $request){
             $speciality=Speciality::get();
             
            return view('DataCenter.admin_money_method',compact('speciality'));
        }
        
        public function MoneySend1(Request $request){
             $data=$request->all();
            $doctor=datacenternew::latest();
             if(isset($data['speciality']) && $data['speciality']!=''){
                $doctor->where('docterSpeciality','like','%'.$data['speciality'].'%');
            }
        if(isset($data['pno']) && $data['pno']!=''){
            $doctor->where('pno','like','%'.$data['pno'].'%');
         }
         
          if(isset($data['fname']) && $data ['fname'] !=''){
             $doctor->where('firstname','like','%'.$data['fname'].'%');
        }
        
        if(isset($data['lname']) && $data ['lname'] !=''){
             $doctor->where('lastname','like','%'.$data['lname'].'%');
        }
             if ($request->ajax()) {
                return Datatables::of($doctor->get())            
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                           
                        })
                        ->rawColumns(['action'])
                      
                        ->make(true);
                    
            }
        }
        
        public function  MoneyPulk(Request $req){
             $pno=datacenternew::get();
            $speciality=Speciality::get();
           
           return view('DataCenter.PulkMoneySend',compact('speciality','pno'));
        }
        
        public function AdminMoneySend(Request $req){
            // dd($req->all());
        $v = $req->all();
        // dd($v);
        $response_data = [];
        $validator = Validator::make(
            $v,
            []
        );
        if (!$validator->fails()) {
            $adminSendMoney=new adminMoneysend();
            $adminSendMoney->money=$req->money;
            $adminSendMoney->comments=$req->comments;
            $adminSendMoney->docter_id=$req->docterId;
            $adminSendMoney->status='Money Sent';
            $adminSendMoney->user_id=$req->userId;
            $adminSendMoney->user_name=$req->user_name;
            $adminSendMoney->updated_at=Carbon::now();
           
            if($adminSendMoney->save()){
                 $notification= new Doctornotification();
                $notification->user_id =$req->userId;
                $notification->doctor_id = $req->docterId;
                $notification->user_type = 'user';
                $notification->message_type = 'money';
                $notification->status = '0';
                $notification->send_id = $adminSendMoney->id;

                if($notification->save()){
                    $response_data=["success" => 1, "message" => "Notification Successfully"];

                }
                else{
                    $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                }
               
                $response_data = ["success" => 1, "message" => "Docter Edit Successfully","adminSendMoney" => $adminSendMoney];
                // $response_data = ["success" => 1, "message" => "Docter Edit Successfully","adminSendMoney" => $adminSendMoney];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        }
          return response()->json($response_data);
        }
        public function AdminVoucherSend(Request $req){
            // dd($req->all());
            $v = $req->all();
            // dd($v);
            $response_data = [];
            $validator = Validator::make(
                $v,
                []
            );
            if (!$validator->fails()) {
                $adminSendVoucher=new adminvoucher();
                $adminSendVoucher->docter_id=$req->docter_id;
                $adminSendVoucher->user_id=$req->user_id;
                $adminSendVoucher->user_name=$req->User_name;
                $adminSendVoucher->voucher=$req->voucher_code;
                $adminSendVoucher->status='Pending';
                if($adminSendVoucher->save()){
                    
                $notification= new Doctornotification();
                $notification->user_id =$req->user_id;
                $notification->doctor_id = $req->docter_id;
                $notification->user_type = 'user';
                $notification->message_type = 'vocher';
                $notification->status = '0';
                $notification->send_id = $adminSendVoucher->id;
                
                if($notification->save()){
                    $response_data=["success" => 1, "message" => "Notification Successfully"];

                }
                else{
                    $response_data=["success" => 0, "message" => "Notification unSuccessfully"];
                }
               
                    $response_data = ["success" => 1, "message" => "Docter Edit Successfully","adminSendVoucher" => $adminSendVoucher];
                }else{
                    $response_data = ["success" => 0, "message" => "Site Server Error"];
                }
                return response()->json($response_data);
            }
        }
        public function reddemAcept(Request $request){
       
            return view('DataCenter.redeemaccepted');
        }
        public function reddemAccept1(Request $req){
        //   dd($data=$req->all());
       
        $redeemAccepted = adminMoneysend::with('datacenternew');
         if(isset($req->pno) && $req->pno != ''){
            
        $pno=datacenternew::where('pno','like','%'.$req->pno.'%')->get();
        // dd($pno);
        if(count($pno) > 0)
        {
            foreach( $pno as $p)
            {
             $redeemAccepted->where('docter_id',$p->id);
            }
        }else{
            $redeemAccepted->where('docter_id',0);
        }
         }
        //  dd("hi9")
        if($req->status !=''){
            // dd("hi");
            $redeemAccepted->where('status','like','%'.$req->status.'%');
        }
        //  dd($redeemAccepted->get());
        
            return Datatables::of($redeemAccepted->orderBy('id','Desc')->get())
           
                    ->addIndexColumn()
                
                    ->rawColumns(['action'])
                    ->make(true);
       
            
        }
        
         public function accountRegisterListshow(Request $req){
            // dd("hi");
            $accountview=accountregister::latest();
            // dd($accountview);
            if ($req->ajax()) {
                return Datatables::of($accountview)->make(true);
            }            
            return view('DataCenter.AccountAdminListView');
            
        }
        
         public function fillter(){
            $pno=datacenternew::get();
            $speciality=Speciality::get();
            return view('DataCenter.adminfillter',compact('pno','speciality'));
        }

        public function sending(Request $req){
            $datacenter=datacenternew::where('pno',$req->pno)->first();
            if($datacenter){
                $response_data=["success"=>1,"message"=>"success","datacenter"=>$datacenter];
            }
            else{
                $response_data=["success"=>0,"fail"=>"fail"];
            }
            return response()->json($response_data);
            
        }
        public function getcontent(Request $req){
            // dd($req->all());
            // dd($req->all());
              $email=$req->email;
            $content=$req->content;
        
            if($req->email && $req->content){
                // dd("hi");
              event(new SendDoctorpnoMail([$req->email,$req->content]));
              
               $response_data = ["success" => 2, "message" => "mail sent success"];
            }else{
              
                 $response_data = ["success" => 4, "message" => "please fill the content"];
            }
           
          return response()->json($response_data);
            
        }
        public function docterfillter(Request $req){
            if($req->speciality !="")
            {
            $doctor = [];
            foreach($req->speciality as $key => $s)
            {
                $speciality =datacenternew::select('id','docterspeciality','firstname','lastname','user_id')->where('docterspeciality',$s)->get()->toArray();
               if(count($speciality) > 0)
                array_push($doctor,$speciality);
            }
                $response_data = ["success" => 1, "message" => "Docter speciality","doctor" => $doctor];
            }else{
                 $response_data = ["success" => 0, "message" => "Not Docter speciality"];
            }
            
            //($supplierManagement);
            return response()->json($response_data);
        }
        
        public function bulkMoneySend(Request $req){
            // dd($req->all());
            // $datausername
            if($req->data != ''){
                foreach($req->data as $key=> $data){
                    // dd($data["username"]);
                    
                    // echo "hi";
                    $bulkmoney=new adminMoneysend();
                    $bulkmoney->user_name= $data['username'];
                    $bulkmoney->user_id= $data['user_id'];
                    $bulkmoney->docter_id=$data['doctor_id'];
                    $bulkmoney->money=$data['sendmoney'];
                    $bulkmoney->comments=$data['message'];
                    $bulkmoney->status='Money Sent';
                   if($bulkmoney->save()){
                  
                       $notification= new Doctornotification();
                       $notification->user_id=$data['user_id'];
                       $notification->doctor_id=$data['doctor_id'];
                       $notification->user_type = 'user';
                       $notification->message_type = 'money';
                       $notification->status = '0';
                       $notification->send_id=$bulkmoney->id;
                      $notification->save();
                }
            }
                //   dd('hi');
             $response_data=["success" => 1, "message" => "notification Successfully"];
            }else{
               $response_data=["success" => 4, "message" => "error send not "];
            }
              return response()->json($response_data);
        }
        public function doctorMail(Request $req){
          
                //   dd($req->data);
                // $id = $req->id;
                // dd($id);
                // $contents = $req->email_cont;
                // dd($contents);            
              if($req->data != null){
                 foreach($req->data as $k=>  $data){
                      $doctor_mail_send = datacenternew::where('id',$data['id'])->first();
                      if($data['content'])
                      {
                          $doctor_mail_send->email_content = $data['content'];
                            // $doctor_mail_send = '';
                      }
                      
                      if(isset($data ['file']) && $data ['file'] !="")
                      {
                            $file = $data['file'];
                          $extension = $file->getClientOriginalExtension();
                          $filename = time() . 'email_document.' .$extension;
                          $file->move('doctor_inbox', $filename);
                          $doctor_mail_send->file_content = 'doctor_inbox/' . $filename;
                      }
                    //   if($data['content'] !="" ){
                    //         $doctor_mail_send->email_content = $data['content'];
                            
                        //     $file = $data['file'];
                        //   $extension = $file->getClientOriginalExtension();
                        //   $filename = time() . 'email_document.' .$extension;
                        //   $file->move('doctor_inbox', $filename);
                        //   $doctor_mail_send->file_content = 'doctor_inbox/' . $filename;
                            
                    //   }

                     if($doctor_mail_send->save()){

                      $email_store = new doctor_pno();
                      $email_store->pno=$data['id'];
                      if($data['content'] !="")
                      {
                        $email_store->message =$data['content'];
                      }
                      if($data['file'] !="")
                      {
                        $email_store->file_upload= $doctor_mail_send->file_content;
                      }
                     
                      $email_store->type='speciality';
                     $email_store->save();
                     
                    
                    }

                    event(new SendDoctorMail([$doctor_mail_send->email,$data['content'],$doctor_mail_send->file_content]));
                    
                }
                 $response_data=["success"=>1,"message"=>"Mail Send Successfully"];
              }else{
                 $response_data=["success"=>2,"message"=>"Mail Not Send"];
               }
               return response()->json($response_data);
            }
            
            public function notifymoney(Request $req){
            $notificationmoney = Doctornotification::where('user_id',$req->user_id)->where('message_type','money')->where('status','0')->update(['status'=>'1']);

            if($notificationmoney){
                $response_data=["success"=>1];
            }
            else{
                $response_data=["success"=>0];
            }
            return response()->json($response_data);

            }
            public function notifyvocher(Request $req){
                $notificationmoney = Doctornotification::where('user_id',$req->user_id)->where('message_type','vocher')->update(['status'=>'1']);
    
                if($notificationmoney){
                    $response_data=["success"=>1];
                }
                else{
                    $response_data=["success"=>0];
                }

                return response()->json($response_data);
            }
            
        public function paid(Request  $req){
            // dd($req->all());
            $paid=adminMoneysend::where('id',$req->yes_button)->first();
            $paid->status='Paid';
            if($paid->save()){
            $response_data = ["success" => 1, "message" => "Docter paid Successfully","paid" => $paid];
            }else{
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
            return response()->json($response_data);
           
        }

     public function DoctorExport (Request $req){
        // dd($req->all());
      $download=datacenternew::where('id', $req->doctor_id)->first();
    //   dd($download);

    // return Excel::download(new DoctorExport, 'disney.xlsx');
    return Excel::download(new DoctorExport($req->doctor_id), 'MttRegistrations.xlsx');
   }
   public function adminoverview(){
                  $country =Country::get();
                   
                   $speciality=Speciality::get();
                  $doctor = datacenternew::count();
                  $doctorRedeemAcceptList = adminMoneysend::where('status','Pending')->count();
                //   dd($doctorRedeemAcceptList);
                //   dd($doctornotification);
                 $doctornotificationmoney = Doctornotification::where('status','2')->where('message_type','money')->count();
                 $doctornotification1 = Doctornotification::where('status','1')->where('message_type','vocher')->count();
                 $doctornotification2 = Doctornotification::where('status','0')->where('message_type','reg')->count();
                  $doctornotificationmv =$doctornotificationmoney;
                 $doctornotification =$doctornotificationmoney+$doctornotification2 ;
                return view('DataCenter.admin_doctor_dashboard',compact('doctor','doctornotificationmoney','doctornotification','doctornotification1','doctornotification2','doctornotificationmv','doctorRedeemAcceptList','country','speciality'));
   }
    public function adminconcept(Request $req){
            $notificationmoney = Doctornotification::where('status','2')->update(['status'=>$req->status]);

            if($notificationmoney){
                $response_data=["success"=>1];
            }
            else{
                $response_data=["success"=>0];
            }
            return response()->json($response_data);

            }
            public function adminreg1(Request $req){
            $notificationmoney = Doctornotification::where('status','0')->where('message_type','reg')->update(['status'=>$req->status]);

            if($notificationmoney){
                $response_data=["success"=>1];
            }
            else{
                $response_data=["success"=>0];
            }
            return response()->json($response_data);

            }
            
    public function adminfillter(Request $req){
        // dd($req->all());
        // dd($req->speciality);
        if($req->country !='' && $req->speciality !=''){
            // dd('hi');
            $datacenter=datacenternew::where('country1',$req->country)->where('docterSpeciality',$req->speciality)->count();
        }
        elseif($req->speciality){
            $datacenter=datacenternew::where('docterSpeciality',$req->speciality)->count();
        }
        elseif($req->country){
            $datacenter=datacenternew::where('country1',$req->country)->count();
        }
        else{
            
        }
        return response()->json(["datacenter"=>$datacenter]);
    }
    
    public function import(Request $request){
        DB::beginTransaction();
        try{
            $import = new UsersImport();
            Excel::import($import, $request->file('file'));
            DB::commit();
              return back()->with('success', 'Imported Successfully');
        }
        // return $response_data;
        catch (\Maatwebsite\Excel\Validators\ValidationException $e){
            DB::rollback();
            $failures=$e->failures();
            $failer_array = [];
            foreach ($failures as $failure) {
                $failer_array[] = $failure->errors()[0]."at row".$failure->row();
            }
            $errors=$failer_array;
           return back()->with('fail', [$errors]);  
        }
       

    }
    
       public function datcenter_performace(Request $req){
       
        $datacenter_total = User::where('user_type','data_center')->get();
         $all1=User::where('user_type','data_center')->select('id')->get()->toArray();
         
         $all=array();
               for($i=0; $i<count($all1); $i++){
                  array_push($all,$all1[$i]['id']); 
               }
               $all2=(implode(',', $all));
        return view('DataCenter.performance',compact('datacenter_total','all2'));
    }

    public function datacenterTotalDoctor(Request $request){
       if($request->id){
           if(is_numeric($request->id)){
                // dd($request->all());
               $datcenter_doctor_total=datacenternew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->where('datacenter_id',$request->id)->count();
               $response_data=["success"=>1,"message"=>"success","datcenter_doctor_total"=>$datcenter_doctor_total];
            } else{
                  $all1=$request->id;
                  $all=array();
                  $all=explode(',',$all1);
                //   dd($all);
              $datcenter_doctor_total=datacenternew::whereDate('created_at','>=',$request->start)->whereDate('created_at','<=',$request->end)->whereIn('datacenter_id',$all)->count();
               $response_data=["success"=>1,"message"=>"success","datcenter_doctor_total"=>$datcenter_doctor_total];
                //   $response_data=["success"=>0,"message"=>"fail"];
               }
            
       }else{
               $response_data=["success"=>0,"message"=>"fail"];
        }
       
         return response()->json($response_data);
       
       
       
       
       
        // if(((isset($req->id) && $req->id !=''))&&((isset($req->start) && $req->start !='' && isset($req->end) && $req->end !=''))){
        //       $datcenter_doctor_total = datacenternew::where('datacenter_id',$req->id)->where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
        // }elseif(($req->id == null) && (isset($req->start) && $req->start !='') && (isset($req->end) && $req->end !='')){
        //       $datcenter_doctor_total = datacenternew::where('created_at','>=',$req->start)->where('created_at','<=',$req->end)->count();
        // }
        // return response()->json(['datcenter_doctor_total'=>$datcenter_doctor_total]);
    }
    
    public function perfomancefilter(Request $request){
         $data=$request->all();
         
          $sales=$data['sales'];
          $doctor=datacenternew::latest();
          
            if($data['daterange']!=''){
             $date=explode("-",$data['daterange']);
             $startdate= date("Y-m-d", strtotime($date[0])); 
             $enddate=date("Y-m-d", strtotime($date[1]));
             
             if(is_numeric($sales)){
                if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($sales) && $sales!=''))){
                    $doctor->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
                    $doctor->where('datacenter_id',$sales);   
                     
                }
             }else{
                    $sales1=array();
                    $sales1=explode(',',$sales);
                    if(((isset($startdate) && $startdate!='' && ($enddate) && $enddate!='')) && ((isset($sales1) && $sales1!=''))){
                         $doctor->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);  
                         $doctor->whereIn('datacenter_id',$sales1);  
                    }
                }
            }
            if ($request->ajax()) {
              return Datatables::of($doctor->get())            
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    
            }
            
    }  
         
        // //  dd($data);
        //  $doctor=datacenternew::latest();
        //  $date=explode("-",$data['daterange']);
        //  $startdate= date("Y-m-d", strtotime($date[0])); 
        //  $enddate=date("Y-m-d", strtotime($date[1]));
        
         
        //  if(((isset($data['sales']) && $data['sales']!=''))&&((isset($startdate) && $startdate!='' && isset($enddate) && $enddate!=''))){
        //      $doctor->where('datacenter_id','like','%'.$data['sales'].'%');
        //      $doctor->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
        // }elseif(((isset($data['sales']) && $data['sales']==''))&&((isset($startdate) && $startdate!='' && isset($enddate) && $enddate!=''))){
        //      $doctor->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate);
        // }
        // if ($request->ajax()) {

        //     return Datatables::of($doctor->get())            
        //             ->addIndexColumn()

        //             ->addColumn('action', function($row){
                       
        //             })
        //             ->rawColumns(['action'])
                  
        //             ->make(true);
                    
        // }
    
     public function performance_view_doctor($id){
        $moneyoption=datacenternew::where('id',$id)->first();
        return view('DataCenter.performance_view_doctor',compact('moneyoption'));
    }
    // public function language()
    // {
    //     $country=Country::get();
    //     $questions = config(('site_questions.questions'));
    //     $answers_9 = config(('answer_key.answers.nine'));
    //     $answers_11 = config(('answer_key.answers.eleven'));
    //     $answers_16 = config(('answer_key.answers.sixteen'));
    //     $answers_17 = config(('answer_key.answers.seventeen'));
    //     $answers_18 = config(('answer_key.answers.eighteen'));
    //     $answers_20 = config(('answer_key.answers.twenty'));
    //     $answers_27 = config(('answer_key.answers.twentyseven'));
    //     $answers_30 = config(('answer_key.answers.thirty'));
    //     $answers_31 = config(('answer_key.answers.thirtyone'));
    //     $answers_33 = config(('answer_key.answers.thirtythree'));

    //     return view('DataCenter.lang' ,compact('country','questions','answers_9','answers_11','answers_16','answers_17','answers_18','answers_20','answers_27','answers_30','answers_31','answers_33'));
    // }
    public function language($id)
    {
        $user_id=$id;
        $country=Country::get();
        $questions = config(('site_questions.questions'));
        $answers_9 = config(('answer_key.answers.nine'));
        $answers_11 = config(('answer_key.answers.eleven'));
        $answers_16 = config(('answer_key.answers.sixteen'));
        $answers_17 = config(('answer_key.answers.seventeen'));
        $answers_18 = config(('answer_key.answers.eighteen'));
        $answers_20 = config(('answer_key.answers.twenty'));
        $answers_27 = config(('answer_key.answers.twentyseven'));
        $answers_30 = config(('answer_key.answers.thirty'));
        $answers_31 = config(('answer_key.answers.thirtyone'));
        $answers_33 = config(('answer_key.answers.thirtythree'));

        return view('DataCenter.new_que_ans' ,compact('country','questions','answers_9','answers_11','answers_16','answers_17','answers_18','answers_20','answers_27','answers_30','answers_31','answers_33','user_id'));
    }
  
    public function change(Request $request)
    {
        // dd($request->lang);
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }

    public function new_register(Request $req)
    {    

       $unique_no = datacenternew::orderBy('id', 'DESC')->with('pno_no','pno_no')->pluck('id')->first();
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
        
        try{
        // dd($req->all());
            $validation = Validator::make($req->all() , [
               
            ]);
            if (!$validation->fails())
            {   
                
                $random_no=uniqid();
                $questions = new Que();
                $questions->country = $req->country;
                $questions->agree_all = $req->agree_all == "on" ? 1 : 0;
                $questions->privacy_policy_condition = $req->agree_all == "on" ? 1 : 0;
                $questions->market_research =$req->agree_all == "on" ? 1 : 0;
                $questions->market_research_purpose = $req->agree_all == "on" ? 1 : 0;
                $questions->mobile_advertising = $req->agree_all == "on" ? 1 : 0;
                $questions->third_party_cookie = $req->agree_all == "on" ? 1 : 0;
                $questions->sensitive_data = $req->agree_all == "on" ? 1 : 0;
                $questions->fname = $req->fname ?? ""; 
                $questions->lname = $req->lname ?? ""; 
                $questions->phone = $req->phone ?? ""; 
                $questions->email = $req->email ?? ""; 
                $questions->address  = $req->address  ?? ""; 
                $questions->zipcode = $req->zipcode ?? "";

                $questions->que_1=$req->que_1 ?? "" ;
                $q_2=(implode(',',$req->que_2));
                $questions->que_2=$q_2 ?? "" ;
                $questions->que_3=$req->que_3 ?? "" ;
                $questions->que_4=$req->que_4 ?? "" ;
                $questions->que_5=$req->que_5 ?? "" ;
                $questions->que_6=$req->que_6 ?? "" ;
                $questions->que_7=$req->que_7 ?? "" ;
                $questions->que_8=$req->que_8 ?? ""  ;
                $questions->que_9=$req->que_9 ?? "" ;
                $questions->que_10=$req->que_10 ?? "" ;

                $q_11=(implode(',',$req->que_11));
                $questions->que_11=$q_11 ?? "" ;
                $questions->que_12=$req->que_12 ?? "" ;
                $questions->que_13=$req->que_13 ?? "" ;
                $questions->que_14=$req->que_14 ?? "" ;
                $questions->que_15=$req->que_15 ?? "" ;
                $q_16=(implode(',',$req->que_16));
                $questions->que_16=$q_16 ?? "" ;
                $q_17=(implode(',',$req->que_17));
                $questions->que_17=$q_17 ?? "" ;
                $questions->que_18=$req->que_18 ?? "" ;
                $questions->que_19=$req->que_19 ?? "" ;
                $q_20=(implode(',',$req->que_20));
                $questions->que_20=$q_20 ?? "" ;

                $questions->que_21=$req->que_21 ?? "" ;
                $questions->que_22=$req->que_22 ?? "" ;
                $questions->que_23=$req->que_23 ?? "" ;
                $questions->que_24=$req->que_24 ?? "" ;
                $questions->que_25=$req->que_25 ?? "" ;
                $questions->que_26=$req->que_26 ?? "" ;
                $questions->que_27=$req->que_27 ?? "" ;
                $questions->que_28=$req->que_28 ?? "" ;
                $questions->que_29=$req->que_29 ?? "" ;
                $questions->que_30=$req->que_30 ?? "" ;
    
                $questions->que_31=$req->que_31 ?? "" ;
                $questions->que_32=$req->que_32 ?? "" ;
                $q_33=(implode(',',$req->que_33));
                $questions->que_33=$q_33 ?? "" ;
                $questions->que_34=$req->que_34 ?? "" ;
                $questions->que_35=$req->que_35 ?? "" ;
                $questions->que_36=$req->que_36 ?? "" ;
                $questions->que_37=$req->que_37 ;
                $encrypted = Crypt::encryptString($req->email);
                $questions->token =$encrypted;
                $questions->Membershipstatus =0;
                $questions->password = $random_no;

                $questions->user_id = $req->userid?$req->userid:null;
                if($questions->save())
                {

                    
                    $create = new User();
                    
                    $create->name = "$questions->fname$questions->lname";
                    $create->email = $questions->email;
                    $create->user_type = 'user';
                    $create->user_role = 'user';
                    $create->password = Hash::make($random_no);
                    
                   

                    if($create->save()){
                    $datacenter_id=Que::where('id',$questions->id)->update(['link_id' => $create->id]);
                    if($datacenter_id){
                         event(new question_email([$req->email,$encrypted, $create->password]));
                         $response_data = ["success" => 1, "message" => "Registered Successfully"];
                    }
                    else{
                        $response_data = ["success" => 2, "message" => "id not update"];
                    }
                        
                    }

                }
                else{
                    $response_data = ["success" => 2, "message" => "Site Server Error"];
                }
            }else{
                $response_data = ["validation" => 0, "message" => "Validation Error"];
            }  
        }
        catch(Exception $e)
        {
            dd($e);
        }
            return response()->json($response_data);

    }
    
    // user module function 
    
    public function viewProfile(){
        $user_id=Auth::user()->id;
        $view=Que::where('link_id',$user_id)->first();
        return view('user.viewProfile',compact('view'));
    }
    
    // View Question Answer 
    public function viewQus(Request $req)
    {
        $country=Country::get();
        
        return view('DataCenter.ques_ans_overview',compact('country'));

    }
    public function viewQue_search(Request $request){
        $data=$request->all();
        $question=Que::latest();
         if(isset($data['country']) && $data['country']!=''){
            $question->where('country','like','%'.$data['country'].'%');
        }
        if(isset($data['email']) && $data['email']!=''){
            $question->where('email','like','%'.$data['email'].'%');
        }
        
        if(isset($data['name']) && $data ['name'] !=''){
             $question->where('fname','like','%'.$data['name'].'%');
        }
        
        if(isset($data['phone']) && $data ['phone'] !=''){
             $question->where('phone','like','%'.$data['phone'].'%');
        }
        
        if ($request->ajax()) {

            return Datatables::of($question->get())            
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                       
                    })
                    ->rawColumns(['action'])
                  
                    ->make(true);
            
                    
        }
    
    }
    public function answer_key_download($id){
        
        $pdf1=Que::where('id',$id)->get();
        $country=Country::get();
        $questions = config(('site_questions.questions'));
        $answers_9 = config(('answer_key.answers.nine'));
        $answers_11 = config(('answer_key.answers.eleven'));
        $answers_16 = config(('answer_key.answers.sixteen'));
        $answers_17 = config(('answer_key.answers.seventeen'));
        $answers_18 = config(('answer_key.answers.eighteen'));
        $answers_20 = config(('answer_key.answers.twenty'));
        $answers_27 = config(('answer_key.answers.twentyseven'));
        $answers_30 = config(('answer_key.answers.thirty'));
        $answers_31 = config(('answer_key.answers.thirtyone'));
        $answers_33 = config(('answer_key.answers.thirtythree'));

        return view('DataCenter.view_ans_key' ,compact('country','questions','answers_9','answers_11','answers_16','answers_17','answers_18','answers_20','answers_27','answers_30','answers_31','answers_33','pdf1'));
        
    }
    public function answer_key_download_pdf($id){
        
        $pdf1=Que::where('id',$id)->get();
        $country=Country::get();
        $questions = config(('site_questions.questions'));
        $answers_9 = config(('answer_key.answers.nine'));
        $answers_11 = config(('answer_key.answers.eleven'));
        $answers_16 = config(('answer_key.answers.sixteen'));
        $answers_17 = config(('answer_key.answers.seventeen'));
        $answers_18 = config(('answer_key.answers.eighteen'));
        $answers_20 = config(('answer_key.answers.twenty'));
        $answers_27 = config(('answer_key.answers.twentyseven'));
        $answers_30 = config(('answer_key.answers.thirty'));
        $answers_31 = config(('answer_key.answers.thirtyone'));
        $answers_33 = config(('answer_key.answers.thirtythree'));

        $path = 'assets/images/logo-3.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = PDF::loadView('DataCenter.userPdf',compact('country','data','logo','questions','answers_9','answers_11','answers_16','answers_17','answers_18','answers_20','answers_27','answers_30','answers_31','answers_33','pdf1'))->setOptions(['defaultFont' => 'sans-serif']);      
        return $pdf->download('pdf_file.pdf');
    }
}