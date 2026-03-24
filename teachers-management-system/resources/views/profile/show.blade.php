@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-circle"></i> My Profile</h1>
    <a href="{{ route('profile.edit') }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> Edit Profile
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($teacher->profile_image)
                    <img src="{{ asset('storage/' . $teacher->profile_image) }}" alt="Profile" class="img-fluid rounded mb-3" style="max-width: 200px;">
                @else
                    <div style="width: 200px; height: 200px; background-color: #ecf0f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-user" style="font-size: 4rem; color: #95a5a6;"></i>
                    </div>
                @endif
                <h4>{{ $teacher->user->name }}</h4>
                <p class="text-muted">{{ $teacher->user->email }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p><strong>Name:</strong></p>
                        <p>{{ $teacher->user->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p><strong>Email:</strong></p>
                        <p>{{ $teacher->user->email }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p><strong>Phone:</strong></p>
                        <p>{{ $teacher->phone ?? 'Not provided' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p><strong>Subject:</strong></p>
                        <p>{{ $teacher->subject ?? 'Not assigned' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p><strong>Joining Date:</strong></p>
                        <p>{{ $teacher->joining_date ? $teacher->joining_date->format('M d, Y') : 'Not set' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p><strong>Salary:</strong></p>
                        <p>${{ number_format($teacher->salary, 2) }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <p><strong>Address:</strong></p>
                        <p>{{ $teacher->address ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book"></i> Assigned Subjects</h5>
            </div>
            @if($teacher->subjects->isEmpty())
                <div class="card-body text-muted">No subjects assigned yet</div>
            @else
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach($teacher->subjects as $subject)
                            <tr>
                                <td>
                                    <strong>{{ $subject->name }}</strong><br>
                                    <small class="text-muted">Code: {{ $subject->code }}</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
