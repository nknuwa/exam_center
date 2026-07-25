<?php

namespace App\Exports;

use App\Models\CenterChange;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CentersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CenterChange::select(
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'current_center_no',
            'new_center_no',
            'user_id'
        )->get();
    }

    public function headings(): array
    {
        return [
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'current_center_no',
            'new_center_no',
            'user_id'
        ];
    }
}
