<?php

namespace App\Exports;

use App\Models\MediumChange;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MediumExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return MediumChange::select(
            'center_no',
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'medium_no',
            'new_medium_no',
            'user_id'
        )->get();
    }

    public function headings(): array
    {
        return [
            'center_no',
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'medium_no',
            'new_medium_no',
            'user_id'
        ];
    }
}
