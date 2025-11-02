<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_no',
        'date',
        'session',
        'subject_code',
        'paper_code',
        'message',
        'user_id',
    ];
}
