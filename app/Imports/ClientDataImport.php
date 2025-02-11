<?php

namespace App\Imports;

use App\Models\ClientData;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientDataImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        if(empty($row['company_name'])) {
            return null;
        }
        return new ClientData([
            'sr_no' => $row['sr_no'] ?? null,
            'company_name' => $row['company_name'],
            'client_firstname' => $row['client_firstname'],
            'client_lastname' => $row['client_lastname'],
            'title' => $row['title'] ?? null,
            'linkedin_id' => $row['linkedin_id'] ?? null,
            'client_country' => $row['client_country'],
            'phone_number' => $row['phone_number'] ?? null,
            'email_address' => $row['email_address'],
            'comments' => $row['comments'] ?? null,
            'followup_date' => $row['followup_date'] ?? null,
            'user_id' => Auth::id(), // Assign to logged-in user
            'status' => isset($row['status']) ? trim($row['status']) : 'Client',
            
        ]);
    }

    public function rules(): array
    {
        return [
            '*.company_name' => 'nullable|string|max:255',
            '*.client_firstname' => 'nullable|string|max:255',
            '*.client_lastname' => 'nullable|string|max:255',
            '*.client_country' => 'nullable|string|max:255',
            '*.email_address' => 'nullable|email|unique:clientdata,email_address',
            '*.phone_number' => 'nullable|numeric|digits_between:8,15|unique:clientdata,phone_number',
            '*.status' => 'nullable|string|in:Client,Important,Normal,Not Responsive',
        ];
    }
    
}

