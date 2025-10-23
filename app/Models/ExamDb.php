<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDb extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'session',
        'subject_code',
        'paper_code',
        'medium_no',
        'center_no',
        'index_no',
    ];
}
