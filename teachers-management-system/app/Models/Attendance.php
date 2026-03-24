<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'teacher_id',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the teacher associated with this attendance.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
