<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of attendance records.
     */
    public function index(Request $request)
    {
        $query = Attendance::with('teacher.user');

        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->has('date') && $request->date) {
            $query->where('date', $request->date);
        }

        $attendance = $query->paginate(15);
        $teachers = Teacher::all();

        return view('attendance.index', compact('attendance', 'teachers'));
    }

    /**
     * Show the form for creating a new attendance record.
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        return view('attendance.create', compact('teachers'));
    }

    /**
     * Store a newly created attendance record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
        ]);

        // Check if attendance record already exists
        $existingAttendance = Attendance::where('teacher_id', $validated['teacher_id'])
            ->where('date', $validated['date'])
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'Attendance for this teacher on this date already exists!');
        }

        Attendance::create($validated);

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully!');
    }

    /**
     * Show the form for editing the specified attendance record.
     */
    public function edit(Attendance $attendance)
    {
        $teachers = Teacher::with('user')->get();
        return view('attendance.edit', compact('attendance', 'teachers'));
    }

    /**
     * Update the specified attendance record in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully!');
    }

    /**
     * Remove the specified attendance record from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully!');
    }

    /**
     * Mark attendance for multiple teachers on a date.
     */
    public function markAttendance(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.teacher_id' => 'required|exists:teachers,id',
            'attendance.*.status' => 'required|in:present,absent,leave',
        ]);

        foreach ($validated['attendance'] as $record) {
            Attendance::updateOrCreate(
                [
                    'teacher_id' => $record['teacher_id'],
                    'date' => $validated['date'],
                ],
                [
                    'status' => $record['status'],
                ]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance marked successfully!');
    }
}
