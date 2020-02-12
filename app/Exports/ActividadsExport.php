<?php

namespace App\Exports;

use App\Actividad;
use Maatwebsite\Excel\Concerns\FromCollection;

//agregados y tmb en el implements
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActividadsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Actividad::all();
    }

    //todo esto es agregado par aponer headers
    public function headings(): array
    {
        return [
            'id',
            'prospecto',
            'vendedor',
            'tipo',
            'fecha',
            'hora',
            'duracion',
            'descripcion',
            'resultado',
            'creado_por',
            'creacion',
            'editado_por',
            'edicion',

        ];
    }

    //esto es agregado para definir valores, no necesraimente de la tabla, pueden ser formulas, valores etc.
    public function map($actividad): array
    {
        return [
            $actividad->id,
            $actividad->prospecto->empresa,
            $actividad->prospecto->user->name,
            $actividad->tiposdeact->tipo,
            $actividad->fecha,
            $actividad->hora,
            $actividad->duracion,
            $actividad->descripcion,
            $actividad->resultado,
            $actividad->creadopor->name,
            $actividad->created_at,
            $actividad->editadopor->name,
            $actividad->updated_at,
        ];
    }
}
