@extends('layout.Layout')

@section('body-content')
    <div class="container text-center mt-4">
        <h2>Your Cart</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        @if (empty($cart) || count($cart) === 0)
            <p>Your cart is empty. <a href="/"> Please add something</a></p>
        @else
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
                    @php $total = 0; @endphp
                    @foreach ($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>₹{{ number_format($item['price'], 2) }}</td>
                            <td>{{ number_format($item['quantity'], 2) }}</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total: ₹{{ number_format($total, 2) }}</h4>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label for="customer" class="form-label">Customer Name (optional):</label>
                    <input type="text" name="customer" id="customer" class="form-control" placeholder="Walk-in">
                </div>
                <button type="submit" class="btn btn-success">Checkout</button>
                <a href="{{ route('cancelorder') }}" class="btn btn-danger">Cancel order</a>
            </form>

            <div class="container">
                @if (session('err-msg'))
                    <div class="alert text-danger fw-bold">{{ session('err-msg') }}</div>
                @endif

            </div>
        @endif
    </div>
@endsection
