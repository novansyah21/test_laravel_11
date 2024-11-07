@extends('layouts.app')

@section('title', 'Your Sales')

@section('content')
    <div class="container">
        <h1 class="mb-4">Your Sales</h1>

        <!-- Display success message if available -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Sales Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sale Amount</th>
                    <th>Sale Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ number_format($sale->amount, 2) }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>
                            <a href="{{ route('sales.createOrEdit', $sale->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('sales.createOrEdit') }}" class="btn btn-primary">Add New Sale</a>
    </div>
@endsection
