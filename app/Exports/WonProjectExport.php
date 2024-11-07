<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class WonProjectExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return WonProject::all();
    }
}
