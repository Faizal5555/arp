<?php



namespace App\Imports;


use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class DataCenterImport implements ToModel, WithHeadingRow, WithValidation
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
            
        ];
    }
   

     public function model(array $row)
    {
       dd('hi');
    }
  
       
    
  
}