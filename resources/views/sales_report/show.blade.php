@extends('layout.Layout')

@section('body-content')
    <div class="container mt-4">
        <h2>Sales Report Details</h2>
        <div class="mb-3">
            <strong>Date Generated:</strong> {{ $report->report_date }}<br>
            <strong>Total Sales:</strong> ₹{{ $report->total_sales }}<br>
            <strong>Total Orders:</strong> {{ $report->total_orders }}
        </div>
        <h4>Order Details</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Books Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($report->details, true) as $detail)
                    <tr>
                        <td>{{ $detail['id'] }}</td>
                        <td>{{ $detail['customer'] }}</td>
                        <td>{{ $detail['saleDate'] }}</td>
                        <td>₹{{ $detail['amount'] }}</td>
                        <td>
                            @php
                                $booksSold = $detail['books_sold'];
                                if (is_string($booksSold)) {
                                    $decoded = json_decode($booksSold, true);
                                    if (json_last_error() === JSON_ERROR_NONE) {
                                        $booksSold = $decoded;
                                    }
                                }
                            @endphp
                            @if (is_array($booksSold))
                                @foreach ($booksSold as $book)
                                    @php
                                        $bookId = is_array($book) ? ($book['id'] ?? (is_numeric($book[0] ?? null) ? $book[0] : null)) : (is_numeric($book) ? $book : null);
                                        $qty = is_array($book) ? ($book['quantity'] ?? ($book['qty'] ?? ($book[1] ?? '?'))) : '?';
                                        $title = null;
                                        if ($bookId) {
                                            $bookModel = \App\Models\Books::find($bookId);
                                            $title = $bookModel ? $bookModel->title : 'Book #' . $bookId;
                                        }
                                    @endphp
                                    {{ $title ? 'Title: ' . $title : 'Book ID: ' . ($bookId ?? '?') }}, Qty: {{ $qty }}<br>
                                @endforeach
                            @else
                                {{ $booksSold }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('sales_report.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>
@endsection
