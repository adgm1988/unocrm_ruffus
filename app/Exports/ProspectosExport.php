<?php

namespace App\Exports;

use App\Prospecto;
use Maatwebsite\Excel\Concerns\FromCollection;

//agregados y tmb en el implements
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProspectosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prospecto::all();
    }


    //todo esto es agregado par aponer headers
    public function headings(): array
    {
        return [
            'id',
            'empresa',
            'contacto',
            'telefono',
            'correo',
            'procedencia',
            'industria',
            'valor',
            'etapa',
            'estatus',
            'usuario',
            'creacion',
            'edicion'

        ];
    }

    //esto es agregado para definir valores, no necesraimente de la tabla, pueden ser formulas, valores etc.
    public function map($prospecto): array
    {
        return [
            $prospecto->id,
            $prospecto->empresa,
            $prospecto->contacto,
            $prospecto->telefono,
            $prospecto->correo,
            $prospecto->procedencias->procedencia,
            $prospecto->industrias->industria,
            $prospecto->valor,
            $prospecto->etapas->etapa,
            $prospecto->estatus,
            $prospecto->user->name,
            $prospecto->created_at,
            $prospecto->updated_at,
        ];
    }
}
