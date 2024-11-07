<?php

namespace App\Imports;

use App\Models\User;
use App\Models\datacenternew;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
use App\Events\SendMail;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
     use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function rules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'cityname' => 'required',
            'citycode' => 'required',
            'phone_number' => 'required|min:10|numeric',
            'email' => 'required|email|unique:users,email',
            'whatsappnumber' => 'required|min:10|numeric',
            'speciality' => 'required',
            'totalexperience' => 'required',
            'practice' => 'required',
            'licence' => 'required',
            'patientsmonth' => 'required',
            'country' => 'required',
            
        ];
    }
    
    public function __construct()
    {
        
    }
    
    public function model(array $row)
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
        //  dd($pno_no);
         
        $random_no=uniqid();
      $create = new User();
      $create->name = $row['firstname'];
      $create->email = $row['email'];
      $create->user_type = 'doctor';
      $create->user_role = 'doctor';
      $create->password = Hash::make($random_no);
      if($create->save()){
          $new = new datacenternew();
          $encrypted = Crypt::encryptString($row['email']);
          $new->token= $encrypted;
          $new->pno=$pno_no;
          $new->password =$random_no;
          $new->firstname =$row['firstname'];
          $new->lastname =$row['lastname'];
          $new->cityname =$row['cityname'];
          $new->citycode =$row['citycode'];
          $new->PhNumber =$row['phone_number'];
          $new->email=$row['email'];
          $new->whatdsappNumber=$row['whatsappnumber'];
          $new->docterSpeciality=$row['speciality'];
          $new->totalExperience=$row['totalexperience'];
          $new->practice=$row['practice'];
          $new->user_id=$create->id;
          $new->licence=$row['licence'];
          $new->PatientsMonth=$row['patientsmonth'];
          $new->country1=$row['country'];
          $new->datacenter_id=Auth()->user()->id;
          if($new->save()){
               event(new SendMail([$row['email'],$encrypted,$new->password]));
          }
      }
      
       
    }
    
    public function getRowCount(): array
    {
        return $this->row;
    }
    
     
    
}
