<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamData extends Model
{
    use HasFactory;

protected $table = 'exam_data';
    protected $fillable = [
        'center_no',
        'index_no',
        'subject_no',
        'paper_code',
        'status',
    ];

}
