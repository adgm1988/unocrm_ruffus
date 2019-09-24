<?php

namespace App\Exports;

use App\Prospecto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProspectosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prospecto::all();
    }
}
