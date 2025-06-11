<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h2>Invoice</h2>
    <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
    <p><strong>Date:</strong> {{ $invoice->saleDate }}</p>
    <p><strong>Customer:</strong> {{ $invoice->customer }}</p>
    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Total: {{ $invoice->amount }}</h4>
</body>

</html>
