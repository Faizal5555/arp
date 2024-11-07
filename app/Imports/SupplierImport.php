<?php

namespace App\Imports;

use App\Models\Supplier;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SupplierImport implements  ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct()
    {
       

    }
    public function rules(): array
    {
        return [
             'supplier_company' => 'required',
             'supplier_manager' => 'required',
             'supplier_country' => 'required',
             'supplier_email' => 'required|email|max:100|unique:supplier',
             'supplier_phone' => 'required|numeric|max:9',
             'supplier_whatsapp' => 'required|numeric|max:9',
             'other_detail'=>'required',
        ];
    }

    public function model(array $row)
    {
        $unique_no = Supplier::orderBy('id', 'DESC')->pluck('id')->first();
        if($unique_no == null or $unique_no == ""){
            
        $unique_no = 1;
        $dt = Carbon::now();
        //  var_dump($dt->year);
        }
        else{
     
            $unique_no = $unique_no + 001;
            $dt = Carbon::now();
    
        }
        $rfq_no = 'RFQ'.$unique_no. '-' .$dt->year;
        $sp_no = 'SP'.$unique_no. '-' .$dt->year;
        $rfqno = $rfq_no;
        $spno = $sp_no;
        
        $supplier = new Supplier();
        $supplier->rfq_no = $rfqno;
        $supplier->sp_no = $spno;
        $supplier->supplier_company =$row['supplier_company'];
        $supplier->supplier_manager = $row['supplier_manager'];
        $supplier->supplier_email = $row['supplier_email'];
        $supplier->supplier_phone =$row['supplier_phone'];
        $supplier->supplier_whatsapp = $row['supplier_whatsapp'];
        $supplier->supplier_country = $row['supplier_country'];
        $supplier->other_detail = $row['other_detail'];
        $supplier->user_id = auth()->user()->id;
        
       if($supplier->save()){
           
        // dd($supplier);  
       }
       else{
          
       }
       
    }

    // public function getRowCount(): array
    // {
    //     return $this->row;
    // }

  
}
