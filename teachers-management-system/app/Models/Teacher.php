<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'subject',
        'joining_date',
        'salary',
        'profile_image',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the user that owns this teacher profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subjects assigned to this teacher.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }

    /**
     * Get the attendance records for this teacher.
     */
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the salary records for this teacher.
     */
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
