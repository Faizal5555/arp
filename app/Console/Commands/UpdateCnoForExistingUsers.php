<?php

namespace App\Console\Commands;

use App\Models\Que; // Update the model
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class UpdateCnoForExistingQues extends Command
{
    protected $signature = 'update:cno-for-existing-ques'; // Update signature
    protected $description = 'Generate and update CNO for all existing ques entries where CNO is null';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $entries = Que::all(); // Fetch all rows from ques table
        $currentYear = Carbon::now()->year;

        foreach ($entries as $entry) {
            if ($entry->cno === null) { // Update only if 'cno' is null
                $entry->cno = 'CCOD' . $entry->id . '-' . $currentYear;
                $entry->save();
            }
        }

        $this->info('CNO updated for all existing entries in ques table.');
        return 0;
    }
}