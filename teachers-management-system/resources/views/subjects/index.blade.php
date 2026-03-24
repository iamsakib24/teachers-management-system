@extends('layouts.app')
@section('title', 'Subjects')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book"></i> Subjects</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Subject</a>
</div>
<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Teachers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td><strong>{{ $subject->name }}</strong></td>
                    <td>{{ $subject->code }}</td>
                    <td><span class="badge bg-info">{{ $subject->teachers->count() }}</span></td>
                    <td>
                        <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('subjects.assign', $subject) }}" class="btn btn-sm btn-secondary"><i class="fas fa-user-plus"></i></a>
                        <form method="POST" action="{{ route('subjects.destroy', $subject) }}" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No subjects found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">{{ $subjects->links() }}</div>
@endsection
