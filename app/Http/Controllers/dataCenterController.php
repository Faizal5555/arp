<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\datacenternew;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
use App\Models\Incentive;
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
use App\Events\BulkRegistrationMail;
// use Barryvdh\DomPDF\Facade\PDF;
use PDF;

class dataCenterController extends Controller
{
    public function DataNew(Request $req, $id)
    {  
        $country=Country::get();
        $user_id=$id;
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
        return view('DataCenter.newRegistration', compact('country','pno_no','speciality','user_id'));
    }
    public function invite(Request $req){
        return view('DataCenter.invite');
    }
    public function invite1(Request $req)
    {
        // Validate the file types and email content
        $validator = Validator::make(
            $req->all(),
            [
                'emailFile' => 'nullable|file|mimes:csv,txt,xlsx|max:2048', // Include xlsx
                'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048',
                'emailContent' => 'required|string'
            ]
        );
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
    
        $emails = [];
    
        // Process the uploaded file if provided
        if ($req->hasFile('emailFile')) {
            $file = $req->file('emailFile');
            $filePath = $file->getRealPath();
            $fileExtension = $file->getClientOriginalExtension();
    
            if ($fileExtension === 'txt') {
                // Read emails from TXT file
                $emails = array_merge($emails, file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
            } elseif ($fileExtension === 'csv') {
                // Read emails from CSV file
                $file = fopen($filePath, 'r');
                while (($line = fgetcsv($file)) !== false) {
                    $emails = array_merge($emails, $line);
                }
                fclose($file);
            } elseif ($fileExtension === 'xlsx') {
                // Read emails from XLSX file using PhpSpreadsheet
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                foreach ($worksheet->getRowIterator() as $row) {
                    $cell = $row->getCellIterator()->current();
                    if ($cell && filter_var($cell->getValue(), FILTER_VALIDATE_EMAIL)) {
                        $emails[] = $cell->getValue();
                    }
                }
            }
        }
    
        // Validate email addresses
        $validEmails = [];
        $invalidEmails = [];
    
        foreach ($emails as $email) {
            $email = trim($email); // Remove whitespace
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            } else {
                $invalidEmails[] = $email;
            }
        }
    
        if (!empty($invalidEmails)) {
            return response()->json(['error' => 'Invalid email addresses: ' . implode(', ', $invalidEmails)], 400);
        }
    
        // Prepare email content and attachment
        $emailContent = $req->emailContent;
        $attachment = $req->file('attachment');
        $authUserId = auth()->user()->id;
        $link = url("/adminapp/newdoctorregister/{$authUserId}");
    
        // Send emails
        foreach ($validEmails as $email) {
            Mail::send('mails.invite', ['url' => $link, 'emailContent' => $emailContent], function ($mail) use ($email, $attachment) {
                $mail->from('researchaccountmanager@asiaresearchpartners.com', 'researchaccountmanager@asiaresearchpartners.com');
                $mail->to($email);
                $mail->subject('Invitation to Join Our Global Healthcare Research Panel');
                
                if ($attachment) {
                    $mail->attach($attachment->getRealPath(), [
                        'as' => $attachment->getClientOriginalName(),
                        'mime' => $attachment->getMimeType()
                    ]);
                }
            });
        }
    
        return response()->json(['message' => 'Emails sent successfully.']);
    }
    

    public function popinvite(Request $req){
        return view('DataCenter.popinvite');
    }
    public function popinvite1(Request $req)
    {
        // Validate request input, making sure emailContent is required and email/attachment have correct formats.
        $validator = Validator::make(
            $req->all(),
            [
                'email' => 'nullable|string', // Optional for manual input
                'emailFile' => 'nullable|file|mimes:csv,txt|max:2048', // CSV or TXT file
                'attachment' => 'file|mimes:pdf,jpg,jpeg,png|max:2048', // Optional attachment
                'emailContent' => 'required|string' // Required email content
            ]
        );
    
        // If validation fails, return the first error message
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
    
        $emails = [];
    
        // Collect emails from text input if provided
        if ($req->email) {
            $emails = array_merge($emails, explode(',', $req->email));
        }
    
        // Collect emails from uploaded file if provided
        if ($req->hasFile('emailFile')) {
            $file = $req->file('emailFile');
            $filePath = $file->getRealPath();
            $fileExtension = $file->getClientOriginalExtension();
    
            // Process based on file type (TXT or CSV)
            if ($fileExtension === 'txt') {
                $emails = array_merge($emails, file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
            } elseif ($fileExtension === 'csv') {
                $file = fopen($filePath, 'r');
                while (($line = fgetcsv($file)) !== false) {
                    $emails = array_merge($emails, $line);
                }
                fclose($file);
            }
        }
    
        // Remove duplicate emails and trim whitespace
        $emails = array_unique(array_map('trim', $emails));
    
        // Check if there are any valid emails to send to
        if (empty($emails)) {
            return response()->json(['error' => 'No valid emails provided. Please check your input.'], 400);
        }
    
        // Prepare data for sending emails
        $emailContent = $req->emailContent;
        $attachment = $req->file('attachment');
        $userId = Auth::user()->id;
    
        $data = [
            'emails' => $emails,
            'link' => url('/adminapp/b2cregistration/' . $userId),
            'emailContent' => $emailContent,
            'attachment' => $attachment
        ];
    
        // Fire the event to send emails
        event(new SendpopinviteMail($data));
    
        return response()->json(['message' => 'Emails sent successfully.']);
    }
    
    

    public function OutsideDataNew(Request $req ,$id = null)
    {
        $speciality=Speciality::get();
        $country_loop_1=Country::get();
        $user_id = $id;        $unique_no = datacenternew::orderBy('id', 'Desc')->pluck('id')->first();
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
        return view('DataCenter.outsitenewRegistration', compact('country_loop_1','speciality','pno_no','user_id'));
    }
    
    public function NewForm(Request $req)
    {
        $v = $req->all();
         //dd($v);
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
                
                $new->datacenter_id= $req->userid?$req->userid:null;

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
            
            public function adminfillter(Request $req)
            {
                $datacenter = 0;
                $chartData = [];
            
                // Calculate the total doctor count based on filters
                if ($req->country && $req->speciality) {
                    $datacenter = datacenternew::where('country1', $req->country)
                        ->where('docterSpeciality', $req->speciality)
                        ->count();
                } elseif ($req->speciality) {
                    $datacenter = datacenternew::where('docterSpeciality', $req->speciality)
                        ->count();
                } elseif ($req->country) {
                    $datacenter = datacenternew::where('country1', $req->country)
                        ->count();
                } else {
                    $datacenter = datacenternew::count(); // Count all doctors if no filter is applied
                }
            
                // Prepare data for the pie chart
                if ($req->country) {
                    // Chart data based on specialties within the selected country
                    $chartDataQuery = datacenternew::select('docterSpeciality as label', DB::raw('count(*) as count'))
                        ->where('country1', $req->country)
                        ->groupBy('docterSpeciality')
                        ->get();
                } elseif ($req->speciality) {
                    // Chart data based on countries within the selected specialty
                    $chartDataQuery = datacenternew::select('country1 as label', DB::raw('count(*) as count'))
                        ->where('docterSpeciality', $req->speciality)
                        ->groupBy('country1')
                        ->get();
                } else {
                    // Default chart data: distribution by country
                    $chartDataQuery = datacenternew::select('country1 as label', DB::raw('count(*) as count'))
                        ->groupBy('country1')
                        ->get();
                }
            
                // Format chart data as an array of label and count
                $chartData = $chartDataQuery->map(function ($item) {
                    return [
                        'label' => $item->label,
                        'count' => $item->count,
                    ];
                })->toArray();
            
                return response()->json([
                    "datacenter" => $datacenter,
                    "chartData" => $chartData
                ]);
            }

            public function userCountryFilter(Request $req) {
                
                $country = $req->country;

                // Get the IDs of users with user_type 'global_team'
                $globalTeamUserIds = DB::table('users')
                    ->whereIn('user_type', ['global_team','user'])
                    ->pluck('id');
                // dd($globalTeamUserIds);
                // Get total registrations for the pie chart from the `ques` table
                $userChartDataQuery = DB::table('ques')
                    ->select('country as label', DB::raw('count(*) as count'))
                    // ->whereIn('user_id', $globalTeamUserIds) // Filter by user_id
                    ->whereNotNull('country')
                    ->when($country, function ($query) use ($country) {
                        return $query->where('country', $country);
                    })
                    ->groupBy('country')
                    ->get();
                    // dd($userChartDataQuery);
                $userChartData = $userChartDataQuery->map(function ($item) {
                    return [
                        'label' => $item->label,
                        'count' => $item->count,
                    ];
                })->toArray();

                // Get question 26 (Occupation) and question 27 (Organization Industry) data for the selected country
                $occupationData = DB::table('ques')
                    ->select('que_26 as occupation', DB::raw('count(*) as count'))
                    //->whereIn('user_id', $globalTeamUserIds) // Filter by user_id
                    ->when($country, function ($query) use ($country) {
                        return $query->where('country', $country);
                    })
                    ->groupBy('que_26')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'label' => config("answer_key.answers.twentysix.{$item->occupation}", 'Unknown'),
                            'count' => $item->count,
                        ];
                    });

                $industryData = DB::table('ques')
                    ->select('que_27 as industry', DB::raw('count(*) as count'))
                   // ->whereIn('user_id', $globalTeamUserIds) // Filter by user_id
                    ->when($country, function ($query) use ($country) {
                        return $query->where('country', $country);
                    })
                    ->groupBy('que_27')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'label' => config("answer_key.answers.twentyseven.{$item->industry}", 'Unknown'),
                            'count' => $item->count,
                        ];
                    });

                return response()->json([
                    "userChartData" => $userChartData,
                    "occupationData" => $occupationData,
                    "industryData" => $industryData,
                ]);
            }
            
            
            
    
            public function import(Request $request)
            {
                DB::beginTransaction();
                try {
                    $import = new UsersImport();
                    Excel::import($import, $request->file('file'));
                    DB::commit();
                    return back()->with('success', 'Imported Successfully');
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    DB::rollback();
                    $failures = $e->failures();
                    $validationErrors = [];
            
                    foreach ($failures as $failure) {
                        $row = $failure->row(); // Row number where error occurred
                        $attribute = $failure->attribute(); // Column/Field name that caused the error
                        $errors = $failure->errors(); // Array of error messages for that row
                        $values = $failure->values(); // All values for that row
            
                        // Append the column name and value to the error message
                        foreach ($errors as $error) {
                            $errorValue = isset($values[$attribute]) ? $values[$attribute] : 'N/A';
                            $validationErrors[$row][] = "Column '{$attribute}' ({$errorValue}): {$error}";
                        }
                    }
            
                    return back()->with('validationErrors', $validationErrors); // Pass errors to the session
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
    public function language($id = null)
    {
        $user_id=$id;
        $country=Country::get();
        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first(); // Fetch the last user ID
        if ($unique_no === null || $unique_no === "") {
            // If the table is empty
            $unique_no = 1;
            $dt = Carbon::now();
        } else {
            // If the table already has data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
        }

        $cno_no = 'CCOD' . $unique_no . '-' . $dt->year; 
        $questions = config(('site_questions.questions'));
        $answers_8 = config(('answer_key.answers.eight'));
        $answers_11 = config(('answer_key.answers.eleven'));
        $answers_16 = config(('answer_key.answers.sixteen'));
        $answers_17 = config(('answer_key.answers.seventeen'));
        $answers_18 = config(('answer_key.answers.eighteen'));
        $answers_20 = config(('answer_key.answers.twenty'));
        $answers_27 = config(('answer_key.answers.twentyseven'));
        $answers_30 = config(('answer_key.answers.thirty'));
        $answers_31 = config(('answer_key.answers.thirtyone'));
        $answers_33 = config(('answer_key.answers.thirtythree'));

        return view('DataCenter.new_que_ans' ,compact('country','questions','answers_8','answers_11','answers_16','answers_17','answers_18','answers_20','answers_27','answers_30','answers_31','answers_33','user_id','cno_no'));
    }

    // public function languages()
    // {
    // $user_id = null; // No user_id since it's not provided
    // $country = Country::get();
    // $questions = config('site_questions.questions');
    // $answers_9 = config('answer_key.answers.nine');
    // $answers_11 = config('answer_key.answers.eleven');
    // $answers_16 = config('answer_key.answers.sixteen');
    // $answers_17 = config('answer_key.answers.seventeen');
    // $answers_18 = config('answer_key.answers.eighteen');
    // $answers_20 = config('answer_key.answers.twenty');
    // $answers_27 = config('answer_key.answers.twentyseven');
    // $answers_30 = config('answer_key.answers.thirty');
    // $answers_31 = config('answer_key.answers.thirtyone');
    // $answers_33 = config('answer_key.answers.thirtythree');

    // return view('DataCenter.new_que_ans', compact('country', 'questions', 'answers_9', 'answers_11', 'answers_16', 'answers_17', 'answers_18', 'answers_20', 'answers_27', 'answers_30', 'answers_31', 'answers_33', 'user_id'));
    // }

  
    public function change(Request $request)
    {
        // dd($request->lang);
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }

    public function new_register(Request $req)
    {    

        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first(); // Fetch the last user ID

        if ($unique_no === null || $unique_no === "") {
            // If the table is empty
            $unique_no = 1;
            $dt = Carbon::now();
        } else {
            // If the table already has data
            $unique_no = $unique_no + 1;
            $dt = Carbon::now();
        }
        
        $cno_no = 'CCOD' . $unique_no . '-' . $dt->year; 
        
        try{
        // dd($req->all());
            $validation = Validator::make($req->all() , [
               
            ]);
            if (!$validation->fails())
            {   
                
                $random_no=uniqid();
                $questions = new Que();
                $questions->cno = $req->cno;
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
                    $create->country = $questions->country;
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
            $response_data = ["validation" => 0, "message" => $e->getMessage()];
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

    public function panelist()
{
    $countries = Country::get();
    $specialities = Speciality::get();
    return view('DataCenter.panelist', compact('countries', 'specialities'));
}

public function filterDoctors(Request $request)
{
    $doctors = datacenternew::where('datacenter_id', auth()->user()->id);

    if ($request->country) {
        $doctors->where('country1', $request->country); // Assuming 'country1' is the column for country
    }

    if ($request->speciality) {
        $doctors->where('docterSpeciality', $request->speciality); // Assuming 'docterSpeciality' is the column for specialty
    }
    

    $filteredDoctors = $doctors->get();

    return view('DataCenter.doctor_list', compact('filteredDoctors'))->render();
}

public function sendEmailToPanelists(Request $request)
{
    $request->validate([
        'doctors' => 'required|array',
        'emailAttachment' => 'nullable|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx,csv|max:2048',
    ], [
        'doctors.required' => 'Please select at least one doctor.',
        'emailAttachment.mimes' => 'The attachment must be a file of type: pdf, jpg, jpeg, png, doc, docx, xlsx, csv.',
        'emailAttachment.max' => 'The attachment may not be greater than 2MB.',
    ]);
    
    $doctorIds = $request->input('doctors');
    $emailContent = $request->input('emailContent');
    $emailAttachment = $request->file('emailAttachment');

    // Fetch doctors based on validated IDs
    $doctors = datacenternew::whereIn('id', $doctorIds)->get();
  
    //dd($doctors);
    foreach ($doctors as $doctor) {
        Mail::send('mails.panelist_notification', ['doctor' => $doctor, 'emailContent' => $emailContent], function ($message) use ($doctor, $emailAttachment) {
            $message->to($doctor->email)
                    ->subject('Invitation to Join Our Global Healthcare Research Panel')
                    ->from('researchaccountmanager@asiaresearchpartners.com','researchaccountmanager@asiaresearchpartners.com'); 

            if ($emailAttachment) {
                $message->attach($emailAttachment->getPathname(), [
                    'as' => $emailAttachment->getClientOriginalName(),
                    'mime' => $emailAttachment->getMimeType(),
                ]);
            }
        });
    }

    return response()->json(['message' => 'Emails sent successfully.']);
}

public function hcpPanelInvite(Request $request)
{
    $speciality = Speciality::get();
    $countries = Country::get(); // Assuming you have a `Country` model
    return view('DataCenter.hcplist', compact('speciality', 'countries'));
}

public function hcpPanelInviteData(Request $request)
{
    $data = $request->all();
    $hcpInvite = datacenternew::query(); // Adjust the model to your actual one

    if (!empty($data['speciality'])) {
        $hcpInvite->where('docterSpeciality', 'like', '%' . $data['speciality'] . '%');
    }

    if (!empty($data['country'])) {
        $hcpInvite->where('country1', 'like', '%' . $data['country'] . '%');
    }

    return Datatables::of($hcpInvite)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '
                <button class="btn btn-sm btn-warning edit-btn" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function editHcp($id)
{
    $hcp = datacenternew::find($id);
    if ($hcp) {
        $countries = Country::all();
        $specialities = Speciality::all();
        return response()->json(['success' => true, 'data' => $hcp, 'countries' => $countries, 'specialities' => $specialities]);
    }
    return response()->json(['success' => false, 'message' => 'HCP not found']);
}


public function updateHcp(Request $request, $id)
{
    $hcp = datacenternew::find($id); // Replace with your actual model
    if ($hcp) {
        $hcp->update($request->all()); // Update HCP details
        return response()->json(['success' => true, 'message' => 'HCP updated successfully']);
    }
    return response()->json(['success' => false, 'message' => 'HCP not found']);
}


public function deleteHcp($id)
{
    $hcp = datacenternew::find($id); // Replace with your actual model
    if ($hcp) {
        $hcp->delete();
        return response()->json(['success' => true, 'message' => 'HCP record deleted successfully']);
    }
    return response()->json(['success' => false, 'message' => 'HCP not found']);
}


    public function consumerRegistration(Request $request)
    {
        $countries = Country::get(); // Assuming you have a Country model to fetch countries
        return view('DataCenter.consumerlist', compact('countries'));
    }

    public function consumerRegistrationData(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $consumers = Que::query(); // 

        if (isset($data['country']) && $data['country'] != '') {
            $consumers->where('country', 'like', '%' . $data['country'] . '%');
        }

        if ($request->ajax()) {
            return Datatables::of($consumers->get())
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function editConsumer($id)
{
    $consumer = Que::findOrFail($id); // Replace `Que` with your consumer model
    $countries = Country::get(); // Fetch all countries
    return response()->json([
        'success' => true,
        'data' => $consumer,
        'countries' => $countries,
    ]);
}


public function updateConsumer(Request $request, $id)
{
    $consumer = Que::find($id); // Find the record in the `que` table
    if ($consumer) {
        $consumer->update($request->only(['fname', 'lname', 'email', 'phone', 'country'])); // Update specific fields
        return response()->json(['success' => true, 'message' => 'Consumer updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Consumer not found']);
}




public function deleteConsumer($id)
{
    $consumer = Que::findOrFail($id); // Replace `Que` with your consumer model
    $consumer->delete();

    return response()->json([
        'success' => true,
        'message' => 'Consumer deleted successfully.',
    ]);
}


    
public function consumerEmail()
{
    $countries = Country::all(); // Fetch countries
    return view('user.emailpanel', compact('countries'));
}

public function filterUsers(Request $request)
{
    $query = Que::where('user_id',auth()->user()->id);

    if ($request->has('country') && $request->country != '') {
        $query->where('country', 'like', '%' . $request->country . '%');
    }

    if ($request->has('que_26') && $request->que_26 != '') {
        $query->where('que_26', $request->que_26);
    }

    if ($request->has('que_27') && $request->que_27 != '') {
        $query->where('que_27', $request->que_27);
    }

    $filteredUsers = $query->get();

    return view('user.userlist', compact('filteredUsers'));
}

public function sendEmailToUsers(Request $request)
{
    $request->validate([
        'users' => 'required|array',
        'emailAttachment' => 'nullable|file|mimes:pdf|max:2048',
    ],
    [
        'users.required' => 'Please select at least one employee.',
        'emailAttachment.mimes' => 'The attachment must be a file of type: pdf, jpg, jpeg, png, doc, docx, xlsx, csv.',
        'emailAttachment.max' => 'The attachment may not be greater than 2MB.',
    ]);

    $userIds = $request->input('users');
    $emailContent = $request->input('emailContent');
    $emailAttachment = $request->file('emailAttachment');

    $users = Que::whereIn('id', $userIds)->get();

    foreach ($users as $user) {
        Mail::send('mails.user_notification', ['user' => $user, 'emailContent' => $emailContent], function ($message) use ($user, $emailAttachment) {
            $message->to($user->email)
                    ->subject('Consumer Notification')
                    ->from('researchaccountmanager@asiaresearchpartners.com','researchaccountmanager@asiaresearchpartners.com'); 

            if ($emailAttachment) {
                $message->attach($emailAttachment->getPathname(), [
                    'as' => $emailAttachment->getClientOriginalName(),
                    'mime' => $emailAttachment->getMimeType(),
                ]);
            }
        });
    }

    return response()->json(['message' => 'Emails sent successfully.']);
}


    public function userHcpList(Request $request)
    {
        $speciality = Speciality::get(); // Assuming the model for specialities exists
        $countries = Country::get(); // Assuming the model for countries exists
        return view('user.userhcplist', compact('speciality', 'countries'));
    }

    public function userHcpListData(Request $request)
    {
        $data = $request->all();
        $hcpInvite =  datacenternew::where('datacenter_id', auth()->user()->id); // Replace with your actual model
        // Apply filters
        if (!empty($data['speciality'])) {
            $hcpInvite->where('docterSpeciality', 'like', '%' . $data['speciality'] . '%');
        }

        if (!empty($data['country'])) {
            $hcpInvite->where('country1', 'like', '%' . $data['country'] . '%');
        }

        return Datatables::of($hcpInvite)
            ->addIndexColumn()
            ->make(true);
    }

    
    
    public function userconsumerlist(Request $request)
{
    $countries = Country::get(); // Assuming a `Country` model exists
    $occupations = config('answer_key.answers.twentysix'); // Fetch occupation from config
    $industries = config('answer_key.answers.twentyseven'); // Fetch industry from config
    return view('user.userconsumerlist', compact('countries', 'occupations', 'industries'));
}

public function userconsumerlistData(Request $request)
{
    $data = $request->all();
    $consumers = Que::where('user_id', auth()->user()->id); // Replace `Que` with your actual model for consumers

    // Apply filters
    if (!empty($data['country'])) {
        $consumers->where('country', 'like', '%' . $data['country'] . '%');
    }

    if (!empty($data['occupation'])) {
        $consumers->where('que_26', $data['occupation']);
    }

    if (!empty($data['industry'])) {
        $consumers->where('que_27', $data['industry']);
    }

    return Datatables::of($consumers)
        ->addIndexColumn()
        ->editColumn('que_26', function ($row) {
            return config('answer_key.answers.twentysix')[$row->que_26] ?? 'Unknown';
        })
        ->editColumn('que_27', function ($row) {
            return config('answer_key.answers.twentyseven')[$row->que_27] ?? 'Unknown';
        })
        ->make(true);
}
   

    public function hcpPieChart()
    {
        $countries = Country::get(); // Assuming you have a Country model for dropdowns
        return view('user.hcp_pie_chart', compact('countries'));
    }

    public function hcpCountryFilter(Request $request)
    {
        $country = $request->country;

        // Get the IDs of users with user_type 'global_team'
        $globalTeamUserIds = DB::table('users')
            ->where('user_type', ['global_team','user'])
            ->pluck('id');
    
        // Fetch total HCP registrations grouped by country (filtered by datacenter_id)
        $countryChartData = datacenternew::select('country1 as label', DB::raw('count(*) as count'))
            //->whereIn('datacenter_id', $globalTeamUserIds) // Filter by datacenter_id matching global_team users
            ->when($country, function ($query) use ($country) {
                return $query->where('country1', $country);
            })
            ->groupBy('country1')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->label,
                    'count' => $item->count,
                ];
            });
    
        // Fetch specialties grouped by country (filtered by datacenter_id)
        $specialityChartData = datacenternew::select('docterSpeciality as label', DB::raw('count(*) as count'))
           // ->whereIn('datacenter_id', $globalTeamUserIds) // Filter by datacenter_id matching global_team users
            ->when($country, function ($query) use ($country) {
                return $query->where('country1', $country);
            })
            ->groupBy('docterSpeciality')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->label,
                    'count' => $item->count,
                ];
            });
    
        return response()->json([
            'countryChartData' => $countryChartData,
            'specialityChartData' => $specialityChartData,
        ]);
    }

        public function globalManagerList(Request $request)
        {
        $specialities = Speciality::all(); // Fetching all specialities
        $countries = Country::all(); // Fetching all countries
        $userType = $request->get('user_type', 'user');

        return view('DataCenter.global_list', compact('specialities', 'countries','userType'));
        }

        public function globalManagerListData(Request $request)
        {
            $userType = $request->user_type;
        
            if ($userType === 'doctor') {
                // Fetch doctors from the datacenternews table
                $query = DB::table('datacenternews')
                    ->leftJoin('users as referrers', 'datacenternews.datacenter_id', '=', 'referrers.id') // Join to fetch referrer name
                    ->select(
                        'datacenternews.docterSpeciality', 
                        'datacenternews.firstname', 
                        'datacenternews.email', 
                        'datacenternews.country1 as country', 
                        'referrers.name as referral' // Fetch referrer name
                    );

                    //dd($query)->get();
        
                if ($request->filled('country')) {
                    $query->where('datacenternews.country1', 'like', '%' . $request->country . '%');
                }
            } elseif ($userType === 'user') {
                // Fetch consumers (users with user_type = 'user') from the que table
                $query = DB::table('ques')
                    ->leftJoin('users as referrers', 'ques.user_id', '=', 'referrers.id') // Join to fetch referrer name
                    ->select(
                        'ques.id as user_id', 
                        'ques.fname as fname', 
                        'ques.lname as lname', 
                        'ques.email', 
                        'ques.country', 
                        'referrers.name as referral' // Fetch referrer name
                    );
        
                if ($request->filled('country')) {
                    $query->where('ques.country', 'like', '%' . $request->country . '%');
                }
            } else {
                // Handle other cases (e.g., invalid user_type) if necessary
                return response()->json(['error' => 'Invalid user type'], 400);
            }
        
            return Datatables::of($query)
            ->filter(function ($query) use ($request, $userType) {
                if ($request->search['value']) {
                    $searchValue = strtolower($request->search['value']); // Convert search value to lowercase
                    $query->where(function ($q) use ($searchValue, $userType) {
                        if ($userType === 'doctor') {
                            // Filters for doctors
                            $q->whereRaw('LOWER(datacenternews.firstname) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(datacenternews.country1) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(datacenternews.docterSpeciality) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(referrers.name) LIKE ?', ['%' . $searchValue . '%']); // Referral name
                        } else {
                            // Filters for consumers
                            $q->whereRaw('LOWER(ques.fname) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(ques.lname) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(ques.country) LIKE ?', ['%' . $searchValue . '%'])
                              ->orWhereRaw('LOWER(referrers.name) LIKE ?', ['%' . $searchValue . '%']); // Referral name
                        }
                    });
                }
            })
            ->addIndexColumn()
            ->editColumn('referral', function ($row) {
                return $row->referral ?? '-'; // Show referral name or hyphen if null
            })
            ->make(true);
        }
        
        
        
        public function globalEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipientEmail' => 'required|email',
            'emailContent' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $email = $request->recipientEmail;
        $emailContent = $request->emailContent;
        $attachment = $request->file('attachment');

        Mail::send('mails.global', ['emailContent' => $emailContent], function ($mail) use ($email, $attachment) {
            $mail->from('researchaccountmanager@asiaresearchpartners.com');
            $mail->to($email);
            $mail->subject('Global Panel Notification');

            if ($attachment) {
                $mail->attach($attachment->getRealPath(), [
                    'as' => $attachment->getClientOriginalName(),
                    'mime' => $attachment->getMimeType()
                ]);
            }
        });

        return response()->json(['message' => 'Email sent successfully.']);
    }
    

    public function getRecruitment()
    {
        $specialities = Speciality::all(); // Fetching all specialities
        $countries = Country::all(); // Fetching all countries
        return view('DataCenter.global_team', compact('specialities', 'countries'));
    }

    public function getRecruitmentData(Request $request)
    {
        $country = $request->get('country');
    
        // Fetch country data
        $countryChartData = DB::table('datacenternews')
        ->select('country1 as label', DB::raw('COUNT(*) as count'))
        ->when($country, function ($query) use ($country) {
            return $query->where('country1', $country);
        })
        ->groupBy('country1')
        ->get();
    
        // Fetch speciality data (filter by country if selected)
        $specialityChartData = DB::table('datacenternews')
            ->select('docterSpeciality as label', DB::raw('COUNT(*) as count'))
            ->when($country, function ($query) use ($country) {
                return $query->where('country1', $country);
            })
            ->groupBy('docterSpeciality')
            ->get();
    
        // Return response with empty data if nothing exists
        return response()->json([
            'countryChartData' => $countryChartData->isEmpty() ? [] : $countryChartData,
            'specialityChartData' => $specialityChartData->isEmpty() ? [] : $specialityChartData,
        ]);
    }

    public function getRecruitmentList(Request $request)
    {
        // Get IDs of users with user_type 'global_team'
        $globalTeamUserIds = DB::table('users')
            ->where('user_type', ['global_team','user'])
            ->pluck('id');
    
        // Fetch data from `datacenternews` filtered by `datacenter_id`
        $data = DB::table('datacenternews')
            ->select(
                DB::raw('LOWER(TRIM(country1)) as normalized_country'), // Normalize country names
                'docterSpeciality as speciality',
                DB::raw('COUNT(*) as count')
            )
            //->whereIn('datacenter_id', $globalTeamUserIds) // Filter by `datacenter_id` for `global_team`
            ->groupBy('normalized_country', 'speciality') // Group by normalized country names and specialties
            ->get();
    
        $formattedData = [];
        $specialities = [];
        $countries = [];
    
        foreach ($data as $item) {
            $country = ucfirst($item->normalized_country); // Convert to title case for display
            $formattedData[$item->speciality][$country] = $item->count;
    
            if (!in_array($item->speciality, $specialities)) {
                $specialities[] = $item->speciality;
            }
            if (!in_array($country, $countries)) {
                $countries[] = $country;
            }
        }
    
        return response()->json([
            'countries' => $countries,
            'specialities' => $specialities,
            'data' => $formattedData,
        ]);
    }
    

    
    
    

    public function panelmemberList(Request $request)
    {
    $specialities = Speciality::all(); // Fetching all specialities
    $countries = Country::all(); // Fetching all countries
    $userType = $request->get('user_type', 'user');

    return view('DataCenter.panelmember', compact('specialities', 'countries','userType'));
    }

    public function panelmemberListData(Request $request)
    {
        $userType = $request->user_type;
        if ($userType === 'doctor') {
            // Fetch doctors from the datacenternews table
            $query = DB::table('datacenternews')
                ->select(
                    'id',
                    'docterSpeciality as speciality',
                    'firstname',
                    'email',
                    'country1 as country',
                    DB::raw('(SELECT COUNT(*) FROM incentives WHERE datacenternews.id = incentives.datacenter_id) as is_saved') // Check if a record is saved
                );
    
            if ($request->filled('country')) {
                $query->orWhere('country1', 'like', '%' . $request->country . '%');
            }
            if ($request->filled('speciality')) {
                $query->where('docterSpeciality', 'like', '%' . $request->speciality . '%');
            }
            if ($request->filled('name')) {
                $query->where('firstname', 'like', '%' . $request->name . '%');
            }
        
            if ($request->filled('lastname')) {
                $query->where('lastname', 'like', '%' . $request->lastname . '%');
            }
        
            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
            
        } else {
            // Fetch consumers (users with user_type = 'user') from the que table
                $query = DB::table('ques')
            ->select(
                'id',
                'fname as fname',
                'lname as lname',
                'country',
                'email',
                DB::raw('(SELECT COUNT(*) FROM incentives WHERE ques.id = incentives.que_id) as is_saved')
            );
    
            if ($request->filled('country')) {
                $query->where('country', 'like', '%' . $request->country . '%');
            }
            if ($request->filled('name')) {
                $query->where('fname', 'like', '%' . $request->name . '%');
            }
        
            if ($request->filled('lastname')) {
                $query->where('lname', 'like', '%' . $request->lastname . '%');
            }
        
            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
        }
    
        return Datatables::of($query)
        ->filterColumn('country', function ($query, $keyword) use ($userType) {
            if ($userType === 'doctor') {
                // Use 'country1' for HCP
                $query->whereRaw("LOWER(country1) LIKE ?", ["%{$keyword}%"]);
            } else {
                // Use 'country' for consumers
                $query->whereRaw("LOWER(country) LIKE ?", ["%{$keyword}%"]);
            }
        })
        ->filter(function ($query) use ($request, $userType) {
            if ($request->search['value']) {
                $query->where(function ($q) use ($request, $userType) {
                    $searchValue = strtolower($request->search['value']); // Convert search value to lowercase
                    if ($userType === 'doctor') {
                        // Filters for HCP (case-insensitive)
                        $q->whereRaw('LOWER(firstname) LIKE ?', ['%' . $searchValue . '%'])
                          ->orWhereRaw('LOWER(country1) LIKE ?', ['%' . $searchValue . '%'])
                          ->orWhereRaw('LOWER(docterSpeciality) LIKE ?', ['%' . $searchValue . '%']); // Include speciality
                    } else {
                        // Filters for consumers (case-insensitive)
                        $q->whereRaw('LOWER(fname) LIKE ?', ['%' . $searchValue . '%'])
                          ->orWhereRaw('LOWER(country) LIKE ?', ['%' . $searchValue . '%'])
                          ->orWhereRaw('LOWER(lname) LIKE ?', ['%' . $searchValue . '%']);
                    }
                });
            }
        })
        ->addIndexColumn()
        ->editColumn('name', function ($row) use ($userType) {
            return $userType === 'doctor'
                ? ($row->firstname ?? 'N/A') // Use 'firstname' for doctors
                : ($row->fname ?? 'N/A'); // Use 'fname' for consumers
        })
        ->editColumn('email', function ($row) {
            return $row->email ?? 'N/A';
        })
        ->editColumn('country', function ($row) {
            return $row->country ?? 'N/A';
        })
        ->addColumn('speciality', function ($row) use ($userType) {
            return $userType === 'doctor'
                ? ($row->speciality ?? 'N/A') // Use speciality for doctors
                : 'N/A'; // Consumers don't have a speciality
        })
        ->make(true);
    
    }
    
        
        
    public function saveIncentive(Request $request)
    {
        // Determine the user type dynamically (HCP or Consumer)
        $userType = $request->input('user_type'); // Pass 'user_type' from the frontend
    
        // Validation
        $request->validate([
            'pn_number' => 'required',
            'incentive_promised' => 'required',
            'total_incentive_paid' => 'required',
            'incentive_paid_date' => 'required|date',
            'mode_of_payment' => 'required',
            'datacenter_id' => $userType === 'doctor' ? 'required' : 'nullable', // Validate only if HCP
            'que_id' => $userType === 'user' ? 'required' : 'nullable', // Validate only if Consumer
        ]);
    
        // Save the incentive data
        $incentive = new Incentive();
        $incentive->user_id = Auth::user()->id; // Use Auth facade for user authentication
    
        // Dynamically set datacenter_id or que_id based on user type
        if ($userType === 'doctor') {
            $incentive->datacenter_id = $request->datacenter_id; // For HCP
            $incentive->que_id = null; // Set que_id to null
        } elseif ($userType === 'user') {
            $incentive->que_id = $request->que_id; // For Consumer
            $incentive->datacenter_id = null; // Set datacenter_id to null
        }
    
        $incentive->pn_number = $request->pn_number;
        $incentive->incentive_promised = $request->incentive_promised;
        $incentive->total_incentive_paid = $request->total_incentive_paid;
        $incentive->incentive_paid_date = $request->incentive_paid_date;
        $incentive->mode_of_payment = $request->mode_of_payment;
        $incentive->save(); // Save the incentive to the database
    
        return response()->json(['message' => 'Incentive data saved successfully!'], 200); // Success response
    }
    
    
        
        public function fetchIncentive($datacenterId)
        {
            
            $incentive = Incentive::where('datacenter_id', $datacenterId)->first();
            if ($incentive) {
                return response()->json($incentive, 200);
            } else {
                return response()->json(['error' => 'Record not found'], 404);
            }
        }

        public function fetchIncentiveConsumer($queId)
        {
            $incentive = Incentive::where('que_id', $queId)->first();
            if ($incentive) {
                return response()->json($incentive, 200);
            } else {
                return response()->json(['error' => 'Record not found'], 404);
            }
        }


        public function PaymentsView()
        {
            return view('DataCenter.paymentview');
        }

        public function fetchPayments(Request $request)
        {
            $request->validate([
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date',
            ]);
        
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        
            $hcpQuery = Incentive::with('datacenternews:id,firstname,country1,docterSpeciality,email')
                ->select('datacenter_id', 'pn_number', 'incentive_promised', 'total_incentive_paid', 'incentive_paid_date', 'mode_of_payment')
                ->whereNotNull('datacenter_id');
        
            $consumerQuery = Incentive::with('ques:id,fname,country,email')
                ->select('que_id', 'pn_number', 'incentive_promised', 'total_incentive_paid', 'incentive_paid_date', 'mode_of_payment')
                ->whereNotNull('que_id');
        
            if ($fromDate) {
                $hcpQuery->whereDate('incentive_paid_date', '>=', $fromDate);
                $consumerQuery->whereDate('incentive_paid_date', '>=', $fromDate);
            }
        
            if ($toDate) {
                $hcpQuery->whereDate('incentive_paid_date', '<=', $toDate);
                $consumerQuery->whereDate('incentive_paid_date', '<=', $toDate);
            }
        
            $hcpRecords = $hcpQuery->get()->map(function ($hcp) {
                return [
                    'name' => optional($hcp->datacenternews)->firstname ?? '',
                    'country' => optional($hcp->datacenternews)->country1 ?? '',
                    'speciality' => optional($hcp->datacenternews)->docterSpeciality ?? '-',
                    'email' => optional($hcp->datacenternews)->email ?? '',
                    'pn_number' => $hcp->pn_number,
                    'incentive_promised' => $hcp->incentive_promised,
                    'total_incentive_paid' => $hcp->total_incentive_paid,
                    'incentive_paid_date' => $hcp->incentive_paid_date,
                    'mode_of_payment' => $hcp->mode_of_payment,
                ];
            });
        
            $consumerRecords = $consumerQuery->get()->map(function ($consumer) {
                return [
                    'name' => optional($consumer->ques)->fname ?? '',
                    'country' => optional($consumer->ques)->country ?? '',
                    'speciality' => '-', // Consumers don't have a speciality
                    'email' => optional($consumer->ques)->email ?? '',
                    'pn_number' => $consumer->pn_number,
                    'incentive_promised' => $consumer->incentive_promised,
                    'total_incentive_paid' => $consumer->total_incentive_paid,
                    'incentive_paid_date' => $consumer->incentive_paid_date,
                    'mode_of_payment' => $consumer->mode_of_payment,
                ];
            });
        
            // Convert to collections and merge
            $combinedRecords = collect($hcpRecords)->merge(collect($consumerRecords));
        
            return response()->json($combinedRecords, 200);
        }
        




    // public function importDoctors(Request $request)
    // {   
    //     //dd($request->all());
    //     $usersToSendMail = []; // Array to collect user details for bulk emails
    //     $validationErrors = []; // To track validation errors
    //     $successfulRows = 0; // To count successful imports
    
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $extension = $file->getClientOriginalExtension();
    
    //         if ($extension !== 'csv') {
    //             return redirect()->back()->withErrors(['file' => 'Invalid file format. Only CSV files are allowed.']);
    //         }
    
    //         $data = array_map('str_getcsv', file($file->getRealPath()));
    //         $header = $data[0];
    //         unset($data[0]); // Remove header row
    
    //         foreach ($data as $index => $row) {
    //             $rowData = array_combine($header, $row); // Combine header with row data
    
    //             // Validate row data
    //             $validator = Validator::make($rowData, [
    //                 'email' => 'required|email|unique:datacenternews,email',
    //                 'firstname' => 'required',
    //                 'lastname' => 'required',
    //                 'cityname' => 'required',
    //                 'citycode' => 'required',
    //                 'phone_number' => 'required|numeric|min:10',
    //                 'whatsappnumber' => 'required|numeric|min:10',
    //                 'speciality' => 'required',
    //                 'totalexperience' => 'required|numeric',
    //                 'practice' => 'required',
    //                 'licence' => 'required',
    //                 'patientsmonth' => 'required|numeric',
    //                 'attachment' => 'nullable',
    //             ]);
    
    //             if ($validator->fails()) {
    //                 $validationErrors[$index + 1] = $validator->errors()->all(); // Store errors with row index
    //                 continue;
    //             }
    
    //             try {
    //                 // Create User
    //                 $random_no = uniqid();
    //                 $user = new User();
    //                 $user->name = $rowData['firstname'];
    //                 $user->email = $rowData['email'];
    //                 $user->user_type = 'doctor';
    //                 $user->user_role = 'doctor';
    //                 $user->password = Hash::make($random_no);
    //                 $user->save();
    
    //                 // Create Doctor Registration Entry
    //                 $datacenter = new datacenternew();
    //                 $datacenter->pno = uniqid('RNOD');
    //                 $datacenter->firstname = $rowData['firstname'];
    //                 $datacenter->lastname = $rowData['lastname'];
    //                 $datacenter->cityname = $rowData['cityname'];
    //                 $datacenter->citycode = $rowData['citycode'];
    //                 $datacenter->PhNumber = $rowData['phone_number'];
    //                 $datacenter->email = $rowData['email'];
    //                 $datacenter->whatdsappNumber = $rowData['whatsappnumber'];
    //                 $datacenter->docterSpeciality = $rowData['speciality'];
    //                 $datacenter->totalExperience = $rowData['totalexperience'];
    //                 $datacenter->practice = $rowData['practice'];
    //                 $datacenter->licence = $rowData['licence'];
    //                 $datacenter->PatientsMonth = $rowData['patientsmonth'];
    //                 $datacenter->country1 = $rowData['country'];
    //                 $datacenter->password =$random_no;
    //                 $datacenter->user_id = $user->id;
    
    //                 // Handle Attachment
    //                 if (isset($rowData['attachment']) && !empty($rowData['attachment'])) {
    //                     $attachmentPath = $rowData['attachment'];
    
    //                     if (filter_var($attachmentPath, FILTER_VALIDATE_URL)) {
    //                         $fileContents = file_get_contents($attachmentPath);
    //                         $fileName = time() . '_' . basename($attachmentPath);
    //                         $savePath = public_path('datacenter/doctor_file/' . $fileName);
    //                         file_put_contents($savePath, $fileContents);
    //                         $datacenter->document = 'datacenter/doctor_file/' . $fileName;
    //                     }
    //                 }
    
    //                 $datacenter->save();
    //                 $successfulRows++; // Increment successful row count
    
    //                 // Collect details for bulk email
    //                 $usersToSendMail[] = [
    //                     'email' => $rowData['email'],
    //                     'encryptedEmail' => Crypt::encryptString($rowData['email']),
    //                     'password' => $random_no,
    //                 ];
    //             } catch (\Exception $e) {
    //                 // Log error if saving fails
    //                 $validationErrors[$index + 1] = [$e->getMessage()];
    //             }
    //         }
    
    //         // Store validation errors in session if any
    //         if (!empty($validationErrors)) {
    //             session()->flash('validationErrors', $validationErrors);
    //         }
    
    //         // Trigger BulkRegistrationMail event after processing valid rows
    //         if (!empty($usersToSendMail)) {
    //             event(new BulkRegistrationMail($usersToSendMail));
    //         }
    
    //         return redirect()->back()->with('success', "$successfulRows rows imported successfully.");
    //     }
    
    //     return redirect()->back()->withErrors(['file' => 'No file uploaded.']);
    // }
    
//     public function getGlobalManagers()
// {
//     $globalManagers = User::where('user_type', 'global_manager')->select('id', 'name', 'email')->get();
//     return response()->json($globalManagers);
// }


public function index(Request $request)

{
    if ($request->isMethod('post') && $request->ajax()) {
        if ($request->get('type') === 'hcp') {
            $hcpData = datacenternew::query();
            return DataTables::of($hcpData)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $searchTerm = $request->search['value'];
                        $query->where(function ($q) use ($searchTerm) {
                            $q->where('pno', 'like', "%{$searchTerm}%")
                              ->orWhere('firstname', 'like', "%{$searchTerm}%")
                              ->orWhere('email', 'like', "%{$searchTerm}%")
                              ->orWhere('country1', 'like', "%{$searchTerm}%")
                              ->orWhere('cityname', 'like', "%{$searchTerm}%")
                              ->orWhere('citycode', 'like', "%{$searchTerm}%")
                              ->orWhere('PhNumber', 'like', "%{$searchTerm}%")
                              ->orWhere('whatdsappNumber', 'like', "%{$searchTerm}%")
                              ->orWhere('docterSpeciality', 'like', "%{$searchTerm}%")
                              ->orWhere('totalExperience', 'like', "%{$searchTerm}%")
                              ->orWhere('practice', 'like', "%{$searchTerm}%")
                              ->orWhere('licence', 'like', "%{$searchTerm}%")
                              ->orWhere('PatientsMonth', 'like', "%{$searchTerm}%")
                              ->orWhereRaw("DATE_FORMAT(created_at, '%d/%m/%Y') LIKE ?", ["%{$searchTerm}%"]);
                        });
                    }
                })
                ->make(true);
        }

        if ($request->get('type') === 'consumer') {
            $answers = config('answer_key.answers'); // Load the answers from the config
            $consumerData = Que::query();

            return DataTables::of($consumerData)
                ->addColumn('que_1', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_1, $answers['one']);
                })
                ->addColumn('que_2', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_2, $answers['two']);
                })
                ->addColumn('que_3', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_3, $answers['three']);
                })
                ->addColumn('que_4', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_4, $answers['four']);
                })
                ->addColumn('que_5', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_5, $answers['five']);
                })
                ->addColumn('que_6', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_6, $answers['six']);
                })
                ->addColumn('que_7', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_7, $answers['seven']);
                })
                ->addColumn('que_8', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_8, $answers['eight']);
                })
                ->addColumn('que_9', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_9, $answers['nine']);
                })
                ->addColumn('que_10', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_10, $answers['ten']);
                })
                ->addColumn('que_11', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_11, $answers['eleven']);
                })
                ->addColumn('que_12', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_12, $answers['twelve']);
                })
                ->addColumn('que_13', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_13, $answers['thirteen']);
                })
                ->addColumn('que_14', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_14, $answers['fourteen']);
                })
                ->addColumn('que_15', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_15, $answers['fifteen']);
                })
                ->addColumn('que_16', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_16, $answers['sixteen']);
                })
                ->addColumn('que_17', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_17, $answers['seventeen']);
                })
                ->addColumn('que_18', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_18, $answers['eighteen']);
                })
                ->addColumn('que_19', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_19, $answers['nineteen']);
                })
                ->addColumn('que_20', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_20, $answers['twenty']);
                })
                ->addColumn('que_21', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_21, $answers['twentyone']);
                })
                ->addColumn('que_22', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_22, $answers['twentytwo']);
                })
                ->addColumn('que_23', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_23, $answers['twentythree']);
                })
                ->addColumn('que_24', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_24, $answers['twentyfour']);
                })
                ->addColumn('que_25', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_25, $answers['twentyfive']);
                })
                ->addColumn('que_26', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_26, $answers['twentysix']);
                })
                ->addColumn('que_27', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_27, $answers['twentyseven']);
                })
                ->addColumn('que_28', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_28, $answers['twentyeight']);
                })
                ->addColumn('que_29', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_29, $answers['twentynine']);
                })
                ->addColumn('que_30', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_30, $answers['thirty']);
                })
                ->addColumn('que_31', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_31, $answers['thirtyone']);
                })
                ->addColumn('que_32', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_32, $answers['thirtytwo']);
                })
                ->addColumn('que_33', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_33, $answers['thirtythree']);
                })
                ->addColumn('que_34', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_33, $answers['thirtyfour']);
                })
                ->addColumn('que_35', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_35, $answers['thirtyfive']);
                })
                ->addColumn('que_36', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_36, $answers['thirtysix']);
                })
                // Add similar columns for all questions up to que_37
                ->addColumn('que_37', function ($row) use ($answers) {
                    return $this->mapAnswers($row->que_37, $answers['thirtyseven']);
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $searchTerm = $request->search['value'];
                        $query->where(function ($q) use ($searchTerm) {
                                $q->where('cno', 'like', "%{$searchTerm}%")
                                ->orwhere('fname', 'like', "%{$searchTerm}%")
                                ->orWhere('lname', 'like', "%{$searchTerm}%")
                                ->orWhere('email', 'like', "%{$searchTerm}%")
                                ->orWhere('phone', 'like', "%{$searchTerm}%")
                                ->orWhere('country', 'like', "%{$searchTerm}%")
                                ->orWhere('address', 'like', "%{$searchTerm}%")
                                ->orWhere('zipcode', 'like', "%{$searchTerm}%")
                                ->orWhereRaw("DATE_FORMAT(created_at, '%d/%m/%Y') LIKE ?", ["%{$searchTerm}%"]);
                        });
                    }
                })
                ->make(true);
        }

    }

    return view('data.index');
}


public function exportHCPData(Request $request)
{
    $type = $request->get('type'); // Get type from the request

    if ($type === 'hcp') {
        $data = datacenternew::select(
            'pno as `Reg ID`',
            'firstname as `First Name`',
            'email as `Email`',
            'country1 as `Country`',
            'cityname as `City`',
            'citycode as `City Code`',
            'PhNumber as `Phone Number`',
            'whatdsappNumber as `WhatsApp Number`',
            'docterSpeciality as `Speciality`',
            'totalExperience as `Experience`',
            'practice as `Practice`',
            'licence as `Licence`',
            'PatientsMonth as `Patients Per Month`',
            DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as `Date`") // Escape the alias `Date`
        )->get();

        // Check if data is empty
        if ($data->isEmpty()) {
            return response()->json(['error' => 'No data available for HCP export.'], 404);
        }

        return response()->json(['data' => $data], 200);
    }elseif ($type === 'consumer') {
        $answers = config('answer_key.answers'); // Load the answers from the config
    
        // Define custom question headings
        $customHeadings = [
            1 => 'place where you live',
            2 => 'interested to be invited',
            3 => 'research studies have a web camera',
            4 => 'Would you be willing to participate in a research',
            5 => 'Do you agree to opt-in and participate in types of research',
            6 => 'track your exposure to certain advertising',
            7 => 'highest level of education',
            8 => 'did you graduate from university/college',
            9 => 'television do you watch per week',
            10 => 'Do you smoke',
            11 => 'brand of cigarettes do you smoke',
            12 => 'how many cigarettes do you smoke in a day',
            13 => 'Do you have access to a car',
            14 => 'automotive-related purchases',
            15 => 'cars are there in your household',
            16 => 'If you own/lease a car(s)',
            17 => 'the car(s) you own/lease',
            18 => 'car (owned or leased) manufactured',
            19 => 'Do you own a motorcycle',
            20 => 'If you own a two wheeled vehicle',
            21 => 'two wheeled vehicle, what engine capacity',
            22 => 'own a two wheeled vehicle',
            23 => 'own/lease a car(s), what fuel do they use',
            24 => 'buying or leasing a new or used car',
            25 => 'your current occupational status',
            26 => 'What is your occupation',
            27 => "organisation's primary industry",
            28 => 'employees work at your organisation',
            29 => 'department do you primarily work',
            30 => "work in your organisation's IT department",
            31 => 'primary role in your organisation',
            32 => 'professional position in the organisation',
            33 => 'illnesses/conditions',
            34 => 'type of cancer',
            35 => 'diagnosed with diabetes',
            36 => 'Do you use glasses or contact lenses',
            37 => 'Do you use a hearing aid',
        ];
    
        $data = Que::get()->map(function ($row) use ($answers, $customHeadings) {
            $exportRow = [
                'Reg ID'=>$row->cno,
                'First Name' => $row->fname,
                'Last Name' => $row->lname,
                'Email' => $row->email,
                'Phone' => $row->phone,
                'Country' => $row->country,
                'Address' => $row->address,
                'Zipcode' => $row->zipcode,
                'Date' => \Carbon\Carbon::parse($row->created_at)->format('d/m/Y'),
            ];
    
            // Add mapped answers for que_1 to que_37 with custom headings
            for ($i = 1; $i <= 37; $i++) {
                $questionKey = "que_$i";
            $answerKey = $this->getAnswerKey($i);
    
                // Use the custom heading if defined, fallback to "Question $i"
                $customHeading = $customHeadings[$i] ?? "Question $i";
    
                $exportRow[$customHeading] = $this->mapAnswers($row->$questionKey, $answers[$answerKey] ?? []);
            }
    
            return $exportRow;
        });
    
        return response()->json(['data' => $data], 200);
    }
}

private function mapAnswers($value, $options)
{
    if (!$value) return ''; // Handle null or empty values

    // Split the values by commas (e.g., "3,42,47")
    $selectedOptions = explode(',', $value);

    // Map each numeric option to its corresponding text value
    $mappedOptions = array_map(function ($option) use ($options) {
        return isset($options[$option]) ? $options[$option] : 'N/A';
    }, $selectedOptions);

    // Join the mapped options as a comma-separated string
    return implode(', ', $mappedOptions);
}

private function getAnswerKey($questionNumber)
{
    $map = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        21 => 'twentyone',
        22 => 'twentytwo',
        23 => 'twentythree',
        24 => 'twentyfour',
        25 => 'twentyfive',
        26 => 'twentysix',
        27 => 'twentyseven',
        28 => 'twentyeight',
        29 => 'twentynine',
        30 => 'thirty',
        31 => 'thirtyone',
        32 => 'thirtytwo',
        33 => 'thirtythree',
        34 => 'thirtyfour',
        35 => 'thirtyfive',
        36 => 'thirtysix',
        37 => 'thirtyseven',
        
    ];

    return $map[$questionNumber] ?? '';
}



public function checkEmail(Request $request)
{
    $email = $request->email;
    $phone = $request->phone;

    // Check email in 'users', 'ques', and 'datacenternews' tables
    if ($email) {
        $emailExists = DB::table('users')->where('email', $email)->exists() ||
                       DB::table('ques')->where('email', $email)->exists() ||
                       DB::table('datacenternews')->where('email', $email)->exists();

        if ($emailExists) {
            return response()->json(['status' => 'error', 'message' => 'Email already exists'], 400);
        }
    }

    // Check phone in 'ques' and 'datacenternews' tables
    if ($phone) {
        $phoneExists = DB::table('ques')->where('phone', $phone)->exists() ||
                       DB::table('datacenternews')->where('PhNumber', $phone)->exists();

        if ($phoneExists) {
            return response()->json(['status' => 'error', 'message' => 'Phone number already exists'], 400);
        }
    }

    return response()->json(['status' => 'success', 'message' => 'Validation passed'], 200);
}



    
    

}