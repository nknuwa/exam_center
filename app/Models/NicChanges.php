<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NicChanges extends Model
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
        'old_nic',
        'new_nic',
        'reason',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
