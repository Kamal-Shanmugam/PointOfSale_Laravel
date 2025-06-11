@extends('layout.Layout')

@section('body-content')
    <div class="container mt-4">
        <h2>Invoice</h2>
        <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
        <p><strong>Date:</strong> {{ $invoice->saleDate }}</p>
        <p><strong>Customer:</strong> {{ $invoice->customer }}</p>
        <table class="table table-bordered">
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
                        <td>₹{{ $item['price'] }}</td>
                        <td>{{ number_format($item['quantity'], 2) }}</td>
                        <td>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Total:₹ {{number_format( $invoice->amount,2) }}</h4>

        <div class="container">
            <p class="text"><a href="{{ route('invoice.download', $invoice->id) }}">Download</a>Invoice OR
                return <a href='/'> Home
                </a></p>
        </div>
    </div>
@endsection
