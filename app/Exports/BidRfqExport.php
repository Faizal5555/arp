<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class BidRfqExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BidRfq::all();
    }
}
