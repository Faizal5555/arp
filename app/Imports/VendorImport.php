<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class VendorImport implements ToModel, WithHeadingRow, WithValidation
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
             'vendor_name' => 'required|alpha',
             'vendor_country' => 'required|alpha',
             'vendor_email' => 'required|email|max:100|unique:vendor',
             'vendor_manager' => 'required|alpha',
             'vendor_phoneno' => 'required|numeric|min:9',
             'vendor_whatsapp' => 'required|numeric|min:9',
             
        ];
    }
    public function model(array $row)
    {
        return new Vendor([
            'vendor_name'=>$row['vendor_name'],
            'vendor_country'=>$row['vendor_country'],
            'vendor_email'=>$row['vendor_email'],
            'vendor_manager'=>$row['vendor_manager'],
            'vendor_phoneno'=>$row['vendor_phoneno'],
            'vendor_whatsapp'=>$row['vendor_whatsapp'],
        ]);
    }
}
