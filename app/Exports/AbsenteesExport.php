<?php

namespace App\Exports;

use App\Models\AbsentCandidates;
use App\Models\Absentee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsenteesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AbsentCandidates::select(
            'center_no',
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'user_id'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Center No',
            'Date',
            'Session',
            'Subject No',
            'Paper Code',
            'Index No',
            'User Id'
        ];
    }
}
