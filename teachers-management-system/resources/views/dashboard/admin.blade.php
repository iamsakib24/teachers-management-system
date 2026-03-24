@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="dashboard-stat">
            <i class="fas fa-chalkboard-user" style="font-size: 2rem; color: #3498db;"></i>
            <h3>{{ $totalTeachers }}</h3>
            <p>Total Teachers</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-stat">
            <i class="fas fa-book" style="font-size: 2rem; color: #2ecc71;"></i>
            <h3>{{ $totalSubjects }}</h3>
            <p>Total Subjects</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-stat">
            <i class="fas fa-clipboard-list" style="font-size: 2rem; color: #f39c12;"></i>
            <h3>{{ $totalAttendanceRecords }}</h3>
            <p>Attendance Records</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-stat">
            <i class="fas fa-money-bill" style="font-size: 2rem; color: #e74c3c;"></i>
            <h3>${{ number_format($totalSalaryDistributed, 2) }}</h3>
            <p>Salary Distributed</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-users"></i> Today's Attendance</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-center">
                        <h4 style="color: #2ecc71;">{{ $presentToday }}</h4>
                        <p>Present</p>
                    </div>
                    <div class="col-6 text-center">
                        <h4 style="color: #e74c3c;">{{ $absentToday }}</h4>
                        <p>Absent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Salary Overview</h5>
            </div>
            <div class="card-body">
                <p><strong>Average Salary:</strong> ${{ number_format($averageSalary, 2) }}</p>
                <p><strong>Total Distributed:</strong> ${{ number_format($totalSalaryDistributed, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history"></i> Recent Teachers</h5>
            </div>
            <table class="table table-hover mb-0">
                <tbody>
                    @forelse($recentTeachers as $teacher)
                        <tr>
                            <td>
                                <strong>{{ $teacher->user->name }}</strong><br>
                                <small class="text-muted">{{ $teacher->user->email }}</small>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted">No teachers yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list"></i> Recent Attendance</h5>
            </div>
            <table class="table table-hover mb-0">
                <tbody>
                    @forelse($recentAttendance as $record)
                        <tr>
                            <td>
                                <strong>{{ $record->teacher->user->name }}</strong><br>
                                <small class="text-muted">{{ $record->date->format('M d, Y') }}</small>
                            </td>
                            <td class="text-end">
                                @if($record->status === 'present')
                                    <span class="badge bg-success">Present</span>
                                @elseif($record->status === 'absent')
                                    <span class="badge bg-danger">Absent</span>
                                @else
                                    <span class="badge bg-warning">Leave</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted">No attendance records yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
