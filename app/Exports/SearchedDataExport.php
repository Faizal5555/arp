<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Str;

class SearchedDataExport implements FromArray, WithHeadings, Responsable
{
    use Exportable;

    private $data;
    private $keyword;
    private $fileName = 'searched_data.xlsx';

    public function __construct($data, $keyword = null)
    {
        $this->data = $data;
        $this->keyword = $keyword;
    }

    public function array(): array
    {
        $rows = [];

        foreach ($this->data as $item) {
            $matchFound = false;

            // If keyword exists, only show related matches
            if ($this->keyword) {
                // Check PN Number, Client Name, and Industry for match
                if (Str::contains(strtolower($item->pn_number), strtolower($this->keyword))) {
                    $rows[] = ['Field' => 'PN Number', 'Value' => $item->pn_number, 'Attachment' => 'N/A'];
                    $matchFound = true;
                }
                if (Str::contains(strtolower($item->client_name), strtolower($this->keyword))) {
                    $rows[] = ['Field' => 'Client Name', 'Value' => $item->client_name, 'Attachment' => 'N/A'];
                    $matchFound = true;
                }
                if (Str::contains(strtolower($item->industry), strtolower($this->keyword))) {
                    $rows[] = ['Field' => 'Industry', 'Value' => $item->industry, 'Attachment' => 'N/A'];
                    $matchFound = true;
                }
                $Attachment = $item->attachments ? asset('adminapp/storage/app/public/' . $item->attachments) : 'N/A';
                $rows[] = ['Field' => 'Attachment', 'Value' => '', 'Attachment' => $Attachment];

                // Check Questions and Answers for match
                foreach ($item->questions as $q) {
                    if (Str::contains(strtolower($q->question), strtolower($this->keyword)) || 
                        Str::contains(strtolower($q->answer), strtolower($this->keyword))) {
                        
                        $rows[] = [
                            'Field' => 'Question: ' . $q->question,
                            'Value' => 'Answer: ' . $q->answer,
                            'Attachment' => $q->attachment ? asset('adminapp/storage/app/public/' . $q->attachment) : 'N/A',
                        ];
                        $matchFound = true;
                    }
                }

                // If no match is found in this item, skip it
                if (!$matchFound) {
                    continue;
                }
            } else {
                // If no keyword, export everything
                $rows[] = ['Field' => 'PN Number', 'Value' => $item->pn_number, 'Attachment' => 'N/A'];
                $rows[] = ['Field' => 'Client Name', 'Value' => $item->client_name, 'Attachment' => 'N/A'];
                $rows[] = ['Field' => 'Subject Line', 'Value' => $item->subject_line, 'Attachment' => 'N/A'];
                $rows[] = ['Field' => 'Industry', 'Value' => $item->industry, 'Attachment' => 'N/A'];
                

                $Attachment = $item->attachments ? asset('adminapp/storage/app/public/' . $item->attachments) : 'N/A';
                $rows[] = ['Field' => 'Attachment', 'Value' => '', 'Attachment' => $Attachment];

                foreach ($item->questions as $q) {
                    $rows[] = [
                        'Field' => 'Question: ' . $q->question,
                        'Value' => 'Answer: ' . $q->answer,
                        'Attachment' => $q->attachment ? asset('adminapp/storage/app/public/' . $q->attachment) : 'N/A',
                    ];
                }
            }

            $rows[] = ['Field' => '', 'Value' => '', 'Attachment' => '']; // Spacer row
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['Field', 'Value', 'Attachment'];
    }
}
