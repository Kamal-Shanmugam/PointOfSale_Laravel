@extends('layout.Layout')
@section('body-content')
    <div class="container">

        <nav class="navbar navbar-expand-lg  mt-1  ">
            <div class="container-fluid">

                <span class="navbar-brand mb-0 ms-5  h1">
                    <a href="{{ route('orderslist') }}" class="text text-decoration-none text-dark">Purchase Orders</a>
                </span>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav gap-2 ">
                        <li class="nav-item">
                            <a class="btn btn-md fw-bold" href="{{ route('purchase') }}">New Orders</a>
                        </li>
                        <li>

                            <form action="{{ route('orderslist') }}" method="get" class="mb-3">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Search by book or supplier..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <table class="table table-bordered border-bottom border-primary-subtle text-center">
            <thead class="fw-bold">
                <tr>
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            SNo &uarr;&darr;
                        </a>
                    </td>
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'book_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Book Title <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'supplier_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Supplier <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    {{-- <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'unit_Price', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Unit Price <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td> --}}
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'quantity', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Quantity <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'status', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Status <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col">
                        <a class="text-decoration-none"
                            href="{{ route('orderslist', array_merge(request()->all(), ['sort_by' => 'expected_delivery', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                            Expected Delivery <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @php
                        $index = ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration;
                    @endphp
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $order->book ? $order->book->title : 'N/A' }}</td>
                        <td>{{ $order->supplier ? $order->supplier->supplier_name : 'N/A' }}</td>
                        {{-- <td>{{ $order->unit_Price }}</td> --}}
                        <td>{{ $order->quantity }}</td>
                        <td
                            @if ($order->status === 'Processing') class="text text-warning fw-bold" 
                        @elseif ($order->status === 'Received') class="text text-success fw-bold"
                        @elseif ($order->status === 'Cancelled') class="text text-danger fw-bold" @endif>
                            {{ $order->status }}</td>

                        <td>{{ $order->expected_delivery }}</td>

                        <td>
                            @if ($order->status === 'Processing')
                                <!-- Edit Status Button trigger modal -->
                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editStatusModal{{ $order->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                            @else
                                <p> Completed</p>
                            @endif

                            <!-- Edit Status Modal -->
                            <div class="modal fade" id="editStatusModal{{ $order->id }}" tabindex="-1"
                                aria-labelledby="editStatusModalLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStatusModalLabel{{ $order->id }}">Edit
                                                Order
                                                Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>
                                        <form action="/orders-update/{{ $order->id }}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status{{ $order->id }}"
                                                        class="form-label">Status</label>
                                                    <select name="status" id="status{{ $order->id }}"
                                                        class="form-select" required>
                                                        <option value="Processing"
                                                            {{ $order->status == 'Processing' ? 'selected' : '' }}>
                                                            Processing</option>
                                                        <option value="Received"
                                                            {{ $order->status == 'Received' ? 'selected' : '' }}>
                                                            Received
                                                        </option>
                                                        <option value="Cancelled"
                                                            {{ $order->status == 'Cancelled' ? 'selected' : '' }}>
                                                            Cancelled
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>

    </div>
@endsection
