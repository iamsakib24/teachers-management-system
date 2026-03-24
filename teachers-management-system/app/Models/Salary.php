<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'basic_salary',
        'bonus',
        'deduction',
        'total_salary',
        'payment_date',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deduction' => 'decimal:2',
        'total_salary' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /**
     * Get the teacher associated with this salary.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
