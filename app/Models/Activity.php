<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'date',
        'time_range',
        'location',
        'max_participants',
        'image_path'
    ];
    public function lecturers()
{
    return $this->belongsToMany(User::class, 'activity_lecturer', 'activity_id', 'user_id');
}
}
