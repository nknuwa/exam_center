<?php

namespace App\Exports;

use App\Models\SpecialNote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NoteExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SpecialNote::select(
            'center_no',
            'date',
            'session',
            'subject_code',
            'paper_code',
            'message',
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
            'message',
            'user_id'
        ];
    }
}
