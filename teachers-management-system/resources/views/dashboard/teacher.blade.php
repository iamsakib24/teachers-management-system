@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<h1 class="mb-4"><i class="fas fa-gauge"></i> My Dashboard</h1>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user"></i> My Profile</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($teacher->profile_image)
                            <img src="{{ asset('storage/' . $teacher->profile_image) }}" alt="Profile" class="img-fluid rounded" style="max-width: 150px;">
                        @else
                            <div style="width: 150px; height: 150px; background-color: #ecf0f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-user" style="font-size: 3rem; color: #95a5a6;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p><strong>Name:</strong> {{ $teacher->user->name }}</p>
                        <p><strong>Email:</strong> {{ $teacher->user->email }}</p>
                        <p><strong>Phone:</strong> {{ $teacher->phone ?? 'Not provided' }}</p>
                        <p><strong>Subject:</strong> {{ $teacher->subject ?? 'Not assigned' }}</p>
                        <p><strong>Joining Date:</strong> {{ $teacher->joining_date ? $teacher->joining_date->format('M d, Y') : 'Not set' }}</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Attendance Summary</h5>
            </div>
            <div class="card-body">
                <div class="row text-center mb-3">
                    <div class="col-6">
                        <h4 style="color: #2ecc71;">{{ $presentDays }}</h4>
                        <p>Present Days</p>
                    </div>
                    <div class="col-6">
                        <h4 style="color: #e74c3c;">{{ $absentDays }}</h4>
                        <p>Absent Days</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6">
                        <h4 style="color: #f39c12;">{{ $leaveDays }}</h4>
                        <p>Leave Days</p>
                    </div>
                    <div class="col-6">
                        <h4 style="color: #3498db;">{{ round($attendancePercentage, 2) }}%</h4>
                        <p>Attendance %</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book"></i> Assigned Subjects</h5>
            </div>
            @if($subjects->isEmpty())
                <div class="card-body text-center text-muted">
                    No subjects assigned yet
                </div>
            @else
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach($subjects as $subject)
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

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-salary"></i> Latest Salary</h5>
            </div>
            @if($salaries->isEmpty())
                <div class="card-body text-center text-muted">
                    No salary records yet
                </div>
            @else
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach($salaries as $salary)
                            <tr>
                                <td>
                                    <strong>Basic Salary:</strong> ${{ number_format($salary->basic_salary, 2) }}<br>
                                    <small class="text-muted">{{ $salary->payment_date ? $salary->payment_date->format('M d, Y') : 'Pending' }}</small>
                                </td>
                                <td class="text-end">
                                    <strong style="font-size: 1.2rem; color: #3498db;">
                                        ${{ number_format($salary->total_salary, 2) }}
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-history"></i> Attendance History</h5>
    </div>
    @if($attendance->isEmpty())
        <div class="card-body text-center text-muted">
            No attendance records yet
        </div>
    @else
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $record)
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
@endsection
