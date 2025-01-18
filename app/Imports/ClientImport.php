<?php



namespace App\Imports;


use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class ClientImport implements ToModel, WithHeadingRow, WithValidation
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
        'client_name' => 'required|alpha',
        'client_country' => 'required|alpha',
        'client_manager' => 'required|alpha',
        'client_email' => [
            'required',
            'email',
            'max:100',
            function ($attribute, $value, $fail) {
                // Check if email exists in the clients table
                if (Client::where('client_email', $value)->exists()) {
                    $fail("The email '{$value}' is already registered.");
                }
            },
        ],
        'client_phoneno' => [
            'required',
            'numeric',
            'digits_between:9,15',
            function ($attribute, $value, $fail) {
                // Check if phone number exists in the clients table
                if (Client::where('client_phoneno', $value)->exists()) {
                    $fail("The phone number '{$value}' is already registered.");
                }
            },
        ],
        'client_whatsapp' => 'required|numeric|digits_between:9,15',
    ];
}

   

         public function model(array $row)
    {
        return new Client([
            'client_name'=>$row['client_name'],
            'client_country'=>$row['client_country'],
            'client_email'=>$row['client_email'],
            'client_manager'=>$row['client_manager'],
            'client_phoneno'=>$row['client_phoneno'],
            'client_whatsapp'=>$row['client_whatsapp'],
           
        ]);
    }
  
       
    
  
}
