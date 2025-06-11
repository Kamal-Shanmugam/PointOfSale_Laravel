@extends('layout.Layout')

@section('body-content')
    <div class="container mt-4">
        <h2>Edit Purchase Order Status</h2>
        @if ($errors->any())
            <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="/orders-update/{{ $id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Book</label>
                        <input type="text" class="form-control" value="{{ $order->book ? $order->book->title : 'N/A' }}"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <input type="text" class="form-control"
                            value="{{ $order->supplier ? $order->supplier->supplier_name : 'N/A' }}" disabled>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="text" class="form-control" value="{{ number_format($order->unit_Price, 2) }}"
                            disabled>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" value="{{ number_format($order->quantity, 2) }}"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expected Delivery</label>
                        <input type="text" class="form-control" value="{{ $order->expected_delivery }}" disabled>
                    </div>
                    @if($order->status === 'Processing')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Received">Received</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    @else
                        <div class="alert alert-info">Order status cannot be edited because it is already <b>{{ $order->status }}</b>.</div>
                    @endif
                    <a href="{{ route('orderslist') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
