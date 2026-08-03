<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'description', 
        'university', 
        'file_path', 
        'views',
        'status'
    ];

    protected $casts = [
        'file_path' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}