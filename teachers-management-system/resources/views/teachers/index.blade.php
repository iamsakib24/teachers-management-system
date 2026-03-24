@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-chalkboard-user"></i> Teachers Management</h1>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Teacher
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Joining Date</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td><strong>{{ $teacher->user->name }}</strong></td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->phone ?? 'N/A' }}</td>
                        <td>{{ $teacher->subject ?? 'Not assigned' }}</td>
                        <td>{{ $teacher->joining_date ? $teacher->joining_date->format('M d, Y') : 'N/A' }}</td>
                        <td>${{ number_format($teacher->salary, 2) }}</td>
                        <td>
                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" 
                                        onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No teachers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $teachers->links() }}
</div>
@endsection
