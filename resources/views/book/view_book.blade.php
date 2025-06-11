@extends('layout.Layout')

@section('body-content')
    <div class="container w-50 mt-5">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('Cover_images/' . $book->cover_photo) }}"
                        class="img-fluid rounded-start border border-3 mt-2" alt="cover photo" style="max-height: 200px;">
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $book->title }}</h3>
                        <ul class="list-group list-group-flush list-unstyled">
                            <li><b>Author:</b> {{ $book->author }}</li>
                            <li><b>Publisher:</b> {{ $book->publisher }}</li>
                            <li><b>ISBN:</b> {{ $book->ISBN }}</li>
                            <li><b>Edition:</b> {{ $book->edition }}</li>
                            <li><b>Genre:</b> {{ $book->genre }}</li>
                            {{-- <li><b>Cost:</b> ₹{{ number_format($book->cost, 2) }}</li> --}}
                            <li><b>Price:</b> ₹{{ number_format($book->price, 2) }}</li>
                            <li>Actual Price:<span
                                    class="text-decoration-line-through text-danger">₹{{ $book->price = number_format($book->price * 0.1 + $book->price, 2) }}</span>
                            </li>
                            <li><b>Availability:</b> {{ $book->quantity }}</li>
                        </ul>
                        <div class="mt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
