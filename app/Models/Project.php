<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_name',
        'description',
        'file_path',
        'status',
        'max_members'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id')
            ->withPivot('position', 'status');
    }
    
    public function advisors()
    {
        return $this->belongsToMany(User::class, 'project_advisors', 'project_id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id');
    }
}