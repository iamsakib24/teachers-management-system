@extends('layouts.app')
@section('title', 'Salary Details')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-receipt"></i> Salary Record</h1>
    <div>
        <a href="{{ route('salaries.edit', $salary) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Salary Information</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Teacher:</strong> {{ $salary->teacher->user->name }}</p>
                        <p><strong>Email:</strong> {{ $salary->teacher->user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Payment Date:</strong> {{ $salary->payment_date ? $salary->payment_date->format('M d, Y') : 'Pending' }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                            <p><strong>Basic Salary:</strong></p>
                            <h4 style="color: #3498db;">${{ number_format($salary->basic_salary, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                            <p><strong>Bonus:</strong></p>
                            <h4 style="color: #2ecc71;">+${{ number_format($salary->bonus, 2) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                            <p><strong>Deduction:</strong></p>
                            <h4 style="color: #e74c3c;">-${{ number_format($salary->deduction, 2) }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded" style="background-color: #ecf0f1;">
                            <p><strong>Total Salary:</strong></p>
                            <h4 style="color: #27ae60;">${{ number_format($salary->total_salary, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
