<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Salary;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function adminDashboard()
    {
        $totalTeachers = Teacher::count();
        $totalSubjects = Subject::count();
        $totalAttendanceRecords = Attendance::count();

        // Calculate salary overview
        $totalSalaryDistributed = Salary::sum('total_salary');
        $averageSalary = Teacher::count() > 0 ? Teacher::avg('salary') : 0;

        // Get recent activities
        $recentTeachers = Teacher::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentAttendance = Attendance::with('teacher.user')
            ->latest()
            ->limit(5)
            ->get();

        // Attendance statistics
        $presentToday = Attendance::where('date', now()->toDateString())
            ->where('status', 'present')
            ->count();

        $absentToday = Attendance::where('date', now()->toDateString())
            ->where('status', 'absent')
            ->count();

        return view('dashboard.admin', compact(
            'totalTeachers',
            'totalSubjects',
            'totalAttendanceRecords',
            'totalSalaryDistributed',
            'averageSalary',
            'recentTeachers',
            'recentAttendance',
            'presentToday',
            'absentToday'
        ));
    }

    /**
     * Display teacher dashboard.
     */
    public function teacherDashboard()
    {
        $teacher = auth()->user()->teacher;

        if (!$teacher) {
            return redirect()->route('login');
        }

        $subjects = $teacher->subjects;
        $attendance = $teacher->attendance()
            ->latest()
            ->limit(10)
            ->get();

        $salaries = $teacher->salaries()
            ->latest()
            ->limit(5)
            ->get();

        // Calculate attendance statistics
        $totalAttendance = $teacher->attendance()->count();
        $presentDays = $teacher->attendance()->where('status', 'present')->count();
        $absentDays = $teacher->attendance()->where('status', 'absent')->count();
        $leaveDays = $teacher->attendance()->where('status', 'leave')->count();

        $attendancePercentage = $totalAttendance > 0 ? ($presentDays / $totalAttendance) * 100 : 0;

        return view('dashboard.teacher', compact(
            'teacher',
            'subjects',
            'attendance',
            'salaries',
            'totalAttendance',
            'presentDays',
            'absentDays',
            'leaveDays',
            'attendancePercentage'
        ));
    }
}
