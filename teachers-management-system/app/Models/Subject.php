<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get the teachers assigned to this subject.
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }
}
