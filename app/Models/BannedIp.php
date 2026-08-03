<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedIp extends Model
{
    protected $fillable = [
        'ip_address',
        'reason',
        'banned_by',
    ];

    public function bannedBy()
    {
        return $this->belongsTo(User::class, 'banned_by');
    }
}
