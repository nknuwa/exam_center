<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'session',
        'subject_code',
        'paper_code',
        'index_no',
        'current_center_no',
        'new_center_no',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
