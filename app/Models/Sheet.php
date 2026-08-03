<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'sheet_name', 
        'subject', 
        'level', 
        'term', 
        'file_path', 
        'type', 
        'status',
        'views',
        'downloads'
    ];

    protected $casts = [
        'file_path' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}