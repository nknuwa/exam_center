<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
    ];

    // public $timestamps = false;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
