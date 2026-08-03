<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentCandidates extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_no',
        'date',
        'session',
        'subject_code',
        'paper_code',
        'index_no',
        'exam_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
