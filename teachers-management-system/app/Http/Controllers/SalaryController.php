<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of salaries.
     */
    public function index(Request $request)
    {
        $query = Salary::with('teacher.user');

        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $salaries = $query->paginate(10);
        $teachers = Teacher::all();

        return view('salaries.index', compact('salaries', 'teachers'));
    }

    /**
     * Show the form for creating a new salary record.
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        return view('salaries.create', compact('teachers'));
    }

    /**
     * Store a newly created salary record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'basic_salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
        ]);

        $bonus = $validated['bonus'] ?? 0;
        $deduction = $validated['deduction'] ?? 0;
        $totalSalary = $validated['basic_salary'] + $bonus - $deduction;

        Salary::create([
            'teacher_id' => $validated['teacher_id'],
            'basic_salary' => $validated['basic_salary'],
            'bonus' => $bonus,
            'deduction' => $deduction,
            'total_salary' => $totalSalary,
            'payment_date' => $validated['payment_date'] ?? null,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary record created successfully!');
    }

    /**
     * Display the specified salary record.
     */
    public function show(Salary $salary)
    {
        $salary->load('teacher.user');
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified salary record.
     */
    public function edit(Salary $salary)
    {
        $teachers = Teacher::with('user')->get();
        return view('salaries.edit', compact('salary', 'teachers'));
    }

    /**
     * Update the specified salary record in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'basic_salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
        ]);

        $bonus = $validated['bonus'] ?? 0;
        $deduction = $validated['deduction'] ?? 0;
        $totalSalary = $validated['basic_salary'] + $bonus - $deduction;

        $salary->update([
            'teacher_id' => $validated['teacher_id'],
            'basic_salary' => $validated['basic_salary'],
            'bonus' => $bonus,
            'deduction' => $deduction,
            'total_salary' => $totalSalary,
            'payment_date' => $validated['payment_date'] ?? null,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary record updated successfully!');
    }

    /**
     * Remove the specified salary record from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Salary record deleted successfully!');
    }
}
