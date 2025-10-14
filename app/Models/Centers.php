<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Centers extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'session',
        'center_no',
        'index_no',
        'subject_code',
        'paper_code',
        'medium_no',
    ];

    public function users()
{
    return $this->hasMany(User::class);
}
}
