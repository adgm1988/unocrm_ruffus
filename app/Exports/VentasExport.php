<?php

namespace App\Exports;

use App\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;

//agregados y tmb en el implements
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VentasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Venta::all();
    }


    //todo esto es agregado par aponer headers
    public function headings(): array
    {
        return [
            'id',
            'prospecto',
            'responsable',
            'fecha',
            'monto',
            'detalle',
            'creacion',
            'edicion',

        ];
    }

    //esto es agregado para definir valores, no necesraimente de la tabla, pueden ser formulas, valores etc.
    public function map($venta): array
    {
        return [
            $venta->id,
            $venta->prospecto->empresa,
            $venta->prospecto->user->name,
            $venta->fecha,
            $venta->monto,
            $venta->detalle,
            $venta->created_at,
            $venta->updated_at,
        ];
    }


}
