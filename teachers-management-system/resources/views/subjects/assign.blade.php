@extends('layouts.app')
@section('title', 'Assign Teachers to ' . $subject->name)
@section('content')
<div class="mb-4">
    <h1><i class="fas fa-user-plus"></i> Assign Teachers: {{ $subject->name }}</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('subjects.assign.store', $subject) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><strong>Select Teachers</strong></label>
                        <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;">
                            @forelse($teachers as $teacher)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="teacher_ids[]" 
                                           value="{{ $teacher->id }}" id="teacher_{{ $teacher->id }}"
                                           @if(in_array($teacher->id, $assignedTeachers)) checked @endif>
                                    <label class="form-check-label" for="teacher_{{ $teacher->id }}">
                                        <strong>{{ $teacher->user->name }}</strong><br>
                                        <small class="text-muted">{{ $teacher->user->email }}</small>
                                    </label>
                                </div>
                                <hr>
                            @empty
                                <p class="text-muted text-center">No teachers available</p>
                            @endforelse
                        </div>
                        @error('teacher_ids')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Assign</button>
                        <a href="{{ route('subjects.show', $subject) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
