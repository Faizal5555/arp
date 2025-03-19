<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SearchedDataExport implements FromArray, WithHeadings, Responsable
{
    use Exportable;

    private $data;
    private $fileName = 'searched_data.xlsx';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $rows = [];

            foreach ($this->data as $item) {
                // Header details (once)
                $rows[] = ['Field' => 'PN Number', 'Value' => $item->pn_number, 'Attachment' => ''];
                $rows[] = ['Field' => 'Client Name', 'Value' => $item->client_name, 'Attachment' => ''];
                $rows[] = ['Field' => 'Subject Line', 'Value' => $item->subject_line, 'Attachment' => ''];
                $rows[] = ['Field' => 'Industry', 'Value' => $item->industry, 'Attachment' => ''];
               
                if (!empty($item->attachments)) {
                    $files = explode(',', $item->attachments);
                    foreach ($files as $file) {
                        $file = trim($file);
                        if ($file) {
                            $link = asset('storage/' . ltrim($file, '/')); // Generates full URL
                            $rows[] = [
                                'Field' => 'Attachment',
                                'Value' => '',
                                'Attachment' => $link, // Plain text URL
                            ];
                        }
                    }
                }
                
                $rows[] = [
                    'Field' => 'Team Members',
                    'Value' => collect($item->teamMembers)->pluck('user.name')->implode(', '),
                    'Attachment' => ''
                ];

                // Spacer row
                $rows[] = ['Field' => '', 'Value' => '', 'Attachment' => ''];

                // Questions, Answers, and Attachments (one row per question)
                foreach ($item->questions as $q) {
                    $rows[] = [
                        'Field' => 'Question: ' . $q->question,
                        'Value' => 'Answer: ' . $q->answer,
                        'Attachment' => $q->attachment ? asset('storage/' . $q->attachment) : 'N/A',
                    ];
                }

                // Add a separator between entries
                $rows[] = ['Field' => '', 'Value' => '', 'Attachment' => ''];
            }

            return $rows;
    }

    public function headings(): array
    {
         return ['Field', 'Value', 'Attachment'];
    }
}
