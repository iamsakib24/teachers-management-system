<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'teacher',
        ]);

        // Handle profile image
        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('teachers', 'public');
        }

        // Create teacher
        Teacher::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'salary' => $validated['salary'] ?? 0,
            'profile_image' => $profileImage,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');
    }

    /**
     * Display the specified teacher.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('user', 'subjects', 'attendance', 'salaries');
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subject' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user
        $teacher->user()->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('teachers', 'public');
            $teacher->profile_image = $profileImage;
        }

        // Update teacher
        $teacher->update([
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'salary' => $validated['salary'] ?? $teacher->salary,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->user()->delete();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
