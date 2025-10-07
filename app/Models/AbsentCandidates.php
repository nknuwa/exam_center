<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentCandidates extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'subject_code',
        'paper_code',
        'index_no',
        'center_no',
        'user_id',
    ];

    
}
