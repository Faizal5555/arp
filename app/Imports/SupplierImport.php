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
            'supplier_email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (Supplier::where('supplier_email', $value)->exists()) {
                        $fail("The email '{$value}' already exists.");
                    }
                },
            ],
            'supplier_phone' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Supplier::where('supplier_phone', $value)->exists()) {
                        $fail("The phone number '{$value}' already exists.");
                    }
                },
            ],
            'supplier_whatsapp' => 'required',
            'supplier_country' => 'required',
            'other_detail' => 'required',
        ];
    }

    public function model(array $row)
    {
        $unique_no = Supplier::orderBy('id', 'DESC')->pluck('id')->first() ?? 1;
        $dt = Carbon::now();
        $rfq_no = 'RFQ' . $unique_no . '-' . $dt->year;
        $sp_no = 'SP' . $unique_no . '-' . $dt->year;

        $supplier = new Supplier();
        $supplier->rfq_no = $rfq_no;
        $supplier->sp_no = $sp_no;
        $supplier->supplier_company = $row['supplier_company'];
        $supplier->supplier_manager = $row['supplier_manager'];
        $supplier->supplier_email = $row['supplier_email'];
        $supplier->supplier_phone = $row['supplier_phone'];
        $supplier->supplier_whatsapp = $row['supplier_whatsapp'];
        $supplier->supplier_country = $row['supplier_country'];
        $supplier->other_detail = $row['other_detail'];
        $supplier->user_id = auth()->user()->id;

        $supplier->save();
    }
       
    

  
}
