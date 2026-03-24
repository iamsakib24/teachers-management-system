@extends('layouts.app')
@section('title', 'Attendance Management')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-clipboard-list"></i> Attendance Management</h1>
    <a href="{{ route('attendance.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Mark Attendance</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Teacher</label>
                <select name="teacher_id" class="form-select">
                    <option value="">All Teachers</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @if(request('teacher_id') == $teacher->id) selected @endif>
                            {{ $teacher->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Teacher</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendance as $record)
                <tr>
                    <td><strong>{{ $record->teacher->user->name }}</strong></td>
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
                    <td>
                        <a href="{{ route('attendance.edit', $record) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('attendance.destroy', $record) }}" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No attendance records</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">{{ $attendance->links() }}</div>
@endsection
