<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index()
    {
        $subjects = Subject::paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created subject in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'code' => 'required|string|max:50|unique:subjects',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }

    /**
     * Display the specified subject.
     */
    public function show(Subject $subject)
    {
        $subject->load('teachers');
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified subject in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified subject from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }

    /**
     * Show form to assign subject to teachers.
     */
    public function assignForm(Subject $subject)
    {
        $teachers = Teacher::all();
        $assignedTeachers = $subject->teachers->pluck('id')->toArray();
        return view('subjects.assign', compact('subject', 'teachers', 'assignedTeachers'));
    }

    /**
     * Assign subject to teachers.
     */
    public function assignTeachers(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $subject->teachers()->sync($validated['teacher_ids']);

        return redirect()->route('subjects.show', $subject)->with('success', 'Subject assigned to teachers successfully!');
    }
}
