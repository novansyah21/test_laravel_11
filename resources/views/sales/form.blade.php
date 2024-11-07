@extends('layouts.app')

@section('title', $sale->exists ? 'Edit Sale' : 'Create Sale')

@section('content')
    <div class="container">
        <h1>{{ $sale->exists ? 'Edit Your Sale' : 'Create a New Sale' }}</h1>

        <form action="{{ $sale->exists ? route('sales.update', $sale->id) : route('sales.store') }}" method="POST">
            @csrf
            @if ($sale->exists)
                @method('PUT') <!-- Use PUT for update -->
            @endif

            <div class="mb-3">
                <label for="amount" class="form-label">Sale Amount</label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $sale->amount) }}" required>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sale_date" class="form-label">Sale Date</label>
                <input type="date" class="form-control @error('sale_date') is-invalid @enderror" id="sale_date" name="sale_date" value="{{ old('sale_date', optional($sale->sale_date)->toDateString()) }}" required>
                @error('sale_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ $sale->exists ? 'Update Sale' : 'Create Sale' }}</button>
        </form>
    </div>
@endsection
