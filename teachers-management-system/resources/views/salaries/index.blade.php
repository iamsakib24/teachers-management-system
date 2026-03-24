@extends('layouts.app')
@section('title', 'Salary Management')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-money-bill"></i> Salary Management</h1>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Salary Record</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-10">
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
                <th>Basic Salary</th>
                <th>Bonus</th>
                <th>Deduction</th>
                <th>Total</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
                <tr>
                    <td><strong>{{ $salary->teacher->user->name }}</strong></td>
                    <td>${{ number_format($salary->basic_salary, 2) }}</td>
                    <td><span class="badge bg-success">${{ number_format($salary->bonus, 2) }}</span></td>
                    <td><span class="badge bg-danger">${{ number_format($salary->deduction, 2) }}</span></td>
                    <td><strong>${{ number_format($salary->total_salary, 2) }}</strong></td>
                    <td>{{ $salary->payment_date ? $salary->payment_date->format('M d, Y') : 'Pending' }}</td>
                    <td>
                        <a href="{{ route('salaries.show', $salary) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('salaries.edit', $salary) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('salaries.destroy', $salary) }}" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">No salary records</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">{{ $salaries->links() }}</div>
@endsection
