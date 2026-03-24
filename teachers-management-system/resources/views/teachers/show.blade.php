@extends('layouts.app')

@section('title', 'View Teacher')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-check"></i> Teacher Profile</h1>
    <div>
        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
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
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p><strong>Name:</strong> {{ $teacher->user->name }}</p>
                        <p><strong>Email:</strong> {{ $teacher->user->email }}</p>
                        <p><strong>Phone:</strong> {{ $teacher->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p><strong>Subject:</strong> {{ $teacher->subject ?? 'Not assigned' }}</p>
                        <p><strong>Joining Date:</strong> {{ $teacher->joining_date ? $teacher->joining_date->format('M d, Y') : 'N/A' }}</p>
                        <p><strong>Salary:</strong> ${{ number_format($teacher->salary, 2) }}</p>
                    </div>
                </div>
                <p><strong>Address:</strong> {{ $teacher->address ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book"></i> Assigned Subjects</h5>
            </div>
            @if($teacher->subjects->isEmpty())
                <div class="card-body text-muted">No subjects assigned</div>
            @else
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach($teacher->subjects as $subject)
                            <tr>
                                <td><strong>{{ $subject->name }}</strong> ({{ $subject->code }})</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Recent Attendance</h5>
            </div>
            @if($teacher->attendance->isEmpty())
                <div class="card-body text-muted">No attendance records</div>
            @else
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teacher->attendance->take(5) as $record)
                            <tr>
                                <td>{{ $record->date->format('M d, Y') }}</td>
                                <td>
                                    @if($record->status === 'present')
                                        <span class="badge bg-success">Present</span>
                                    @elseif($record->status === 'absent')
                                        <span class="badge bg-danger">Absent</span>
                                    @else
                                        <span class="badge bg-warning">Leave</span>
                                    @endif
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
