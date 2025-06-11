@extends('layout.Layout')

@section('body-content')
    <nav class="navbar navbar-expand-lg  mt-1  ">
        <div class="container-fluid">

            <span class="navbar-brand mb-0 ms-5  h1">
                <a href="{{ route('inventory') }}" class="text text-decoration-none text-dark">Inventory</a>
            </span>

            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-bold border" href="/orders-list">View Purchase Orders</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </nav>



    <div class="container mt-2 ">
        <div class="text-danger border-bottom d-flex justify-content-between">
            <p class="text-danger fw-bold fs-5"> List of books in the Inventory</p>

            <div>
                <form action="{{ route('inventory', ['search' => 'search']) }}" method="get" class="row g-3 gap-2">

                    {{-- <a href="{{ route('download-book') }}" class="btn btn-primary btn-sm col-auto">Download Book List</a> --}}

                    <a href="{{ route('purchase') }}" class="btn btn-primary btn-sm col-auto">Purchase Books</a>

                    <input type="search" class="col-auto" name="search" id="searchBook" placeholder="Search book here.."
                        style="font-size: 13px;font-weight: bolder;" value="{{ request('search') }}">

                    <button type="submit" style="display:none" class="btn btn-secondary btn-sm col-auto"></button>

                    <div class="">
                        @if ($errors->has('search'))
                            <div class="invalid-feedback">
                                {{ $errors->first('search') }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered border-bottom border-primary-subtle text-center">
            <thead class="fw-bold">
                <tr>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">SNo&uarr;&darr;</a>
                    </td>

                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'title', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Title
                            <i class="bi bi-arrow-down-up"></i></a>
                    </td>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'author', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Author
                            <i class="bi bi-arrow-down-up"></i></a>
                    </td>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'genre', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Genre
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'cost', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Cost
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'price', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Price
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>
                    <td scope="col"><a class="text-decoration-none"
                            href="{{ route('inventory', ['sort_by' => 'quantity', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">Stock
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </td>

                    <td>Cover Photo</td>
                    <td>Action</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($library as $book)
                    @php
                        $index = ($library->currentPage() - 1) * $library->perPage() + $loop->iteration;
                    @endphp


                    <tr>
                        <td> {{ $index }}</td>
                        <td><a href="/book/{{ $book->id }}"> {{ $book->title }} </a></td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>₹{{ number_format($book->cost, 2) }}</td>
                        <td>₹{{ number_format($book->price, 2) }}</td>
                        <td>{{ number_format($book->quantity, 2) }}</td>
                        <td>
                            <img src="Cover_images/{{ $book->cover_photo }}" class="border border-3 mt-2" alt="cover photo"
                                style="max-height: 50px;">
                        </td>
                        <td class="d-flex flex-row justify-content-center gap-1">
                            <a class="btn btn-dark btn-sm" href="/editbook/{{ $book->id }}"><i
                                    class="bi bi-pencil-square">edit</i></a>
                            <a class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure want to delete this book? {{ $book->title }} ')"
                                href="/deletebook/{{ $book->id }}"><i class="bi bi-trash3">Delete</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container text-center">
            {{ $library->withQueryString()->links() }}
        </div>
    </div>
@endsection
