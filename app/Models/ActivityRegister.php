<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id', 
        'user_id', 
        'class_room', 
        'student_no', 
        'phone', 
        'note'
    ];

    protected $casts = [
        'student_no' => 'string',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'first_name' => 'ไม่ระบุ',
            'last_name' => 'ชื่อ',
            'email' => 'N/A'
        ]);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}