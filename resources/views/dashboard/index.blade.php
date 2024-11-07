@extends('layouts.app')

@section('title', 'User Sales Dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">User Sales Dashboard</h1>

        <div class="card shadow-lg mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Sales Data</h4>
            </div>
            <div class="card-body">
                <table id="salesTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Sale Amount</th>
                            <th>Sale Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td>{{ number_format($sale->amount, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#salesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    paginate: {
                        previous: 'Previous',
                        next: 'Next'
                    },
                    search: 'Search:',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries'
                }
            });
        });
    </script>
@endpush
