<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'project_name',
        'advisor',
        'subject',
        'file_path',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}