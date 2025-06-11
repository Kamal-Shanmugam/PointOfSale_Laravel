<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point of Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

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
                        <td>Rs. {{ $detail['amount'] }}</td>
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
                                        $bookId = is_array($book)
                                            ? $book['id'] ?? (is_numeric($book[0] ?? null) ? $book[0] : null)
                                            : (is_numeric($book)
                                                ? $book
                                                : null);
                                        $qty = is_array($book)
                                            ? $book['quantity'] ?? ($book['qty'] ?? ($book[1] ?? '?'))
                                            : '?';
                                        $title = null;
                                        if ($bookId) {
                                            $bookModel = \App\Models\Books::find($bookId);
                                            $title = $bookModel ? $bookModel->title : 'Book #' . $bookId;
                                        }
                                    @endphp
                                    {{ $title ? 'Title: ' . $title : 'Book ID: ' . ($bookId ?? '?') }}, Qty:
                                    {{ $qty }}<br>
                                @endforeach
                            @else
                                {{ $booksSold }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
