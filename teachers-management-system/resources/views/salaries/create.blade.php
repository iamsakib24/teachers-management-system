@extends('layouts.app')
@section('title', 'Add Salary Record')
@section('content')
<div class="mb-4">
    <h1><i class="fas fa-plus-circle"></i> Add Salary Record</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('salaries.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Teacher <span class="text-danger">*</span></label>
                        <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="basic_salary" class="form-label">Basic Salary <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" name="basic_salary" value="{{ old('basic_salary') }}" required>
                        @error('basic_salary')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="bonus" class="form-label">Bonus</label>
                        <input type="number" step="0.01" class="form-control @error('bonus') is-invalid @enderror" id="bonus" name="bonus" value="{{ old('bonus', 0) }}">
                        @error('bonus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="deduction" class="form-label">Deduction</label>
                        <input type="number" step="0.01" class="form-control @error('deduction') is-invalid @enderror" id="deduction" name="deduction" value="{{ old('deduction', 0) }}">
                        @error('deduction')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date') }}">
                        @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Record</button>
                        <a href="{{ route('salaries.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
