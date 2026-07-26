<?php

namespace App\Exports;

use App\Models\NicChanges;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class NicExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return NicChanges::select(
            'center_no',
            'date',
            'session',
            'subject_code',
            'paper_code',
            'index_no',
            'exam_id',
            'old_nic',
            'new_nic',
            'reason',
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
            'exam_id',
            'old_nic',
            'new_nic',
            'reason',
            'user_id'
        ];
    }
}
