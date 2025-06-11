@extends('layout.Layout')

@section('body-content')
    <div class="container mt-4">
        <h2>Sales Reports</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('sales_report.generate') }}" method="POST" class="row g-3 mb-4">
            @csrf
            <div class="col-auto">
                <label for="from" class="form-label">From</label>
                <input type="date" name="from" id="from" class="form-control" required>
            </div>
            <div class="col-auto">
                <label for="to" class="form-label">To</label>
                <input type="date" name="to" id="to" class="form-control" required>
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </form>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date Generated</th>
                    <th>Total Sales</th>
                    <th>Total Orders</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->report_date }}</td>
                        <td>₹{{ number_format($report->total_sales, 2) }}</td>
                        <td>{{ $report->total_orders }}</td>
                        <td class="container d-flex justify-content-center gap-3">
                            <a href="{{ route('sales_report.show', $report->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('sales_report.download', $report->id) }}"target="_blank"
                                class="btn btn-warning btn-sm">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $reports->links() }}
        </div>
    </div>
@endsection
