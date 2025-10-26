<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediumChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_no',
        'date',
        'session',
        'subject_code',
        'paper_code',
        'index_no',
        'medium_no',
        'new_medium_no',
        'user_id',
    ];
}
