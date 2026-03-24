<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the teacher's profile.
     */
    public function show()
    {
        $teacher = auth()->user()->teacher;

        if (!$teacher) {
            return redirect()->route('login');
        }

        $teacher->load('user', 'subjects');
        return view('profile.show', compact('teacher'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $teacher = auth()->user()->teacher;

        if (!$teacher) {
            return redirect()->route('login');
        }

        $teacher->load('user');
        return view('profile.edit', compact('teacher'));
    }

    /**
     * Update the teacher's profile.
     */
    public function update(Request $request)
    {
        $teacher = auth()->user()->teacher;

        if (!$teacher) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
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
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
