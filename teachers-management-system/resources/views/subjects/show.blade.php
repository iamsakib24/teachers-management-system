@extends('layouts.app')
@section('title', $subject->name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book"></i> {{ $subject->name }}</h1>
    <div>
        <a href="{{ route('subjects.assign', $subject) }}" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Assign Teachers</a>
        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header"><h5 class="mb-0">Subject Information</h5></div>
            <div class="card-body">
                <p><strong>Code:</strong> {{ $subject->code }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-chalkboard-user"></i> Assigned Teachers</h5></div>
            @if($teachers->isEmpty())
                <div class="card-body text-muted">No teachers assigned</div>
            @else
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>
                                    <strong>{{ $teacher->user->name }}</strong><br>
                                    <small class="text-muted">{{ $teacher->user->email }}</small>
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
