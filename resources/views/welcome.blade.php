@extends('layout.Layout')
@section('body-content')
    <div class="container">
        <div class="container text-center row">
            <h2 class="text col mt-3 ">Point Of Sale</h2>


            <form action="{{ route('library') }}" method="get" class="col">
                <input type="search" class="" name="search" id="searchBook" placeholder="Search book here.."
                    style="font-size: 13px;font-weight: bolder;" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm col-auto">Search</button>
                <div class="">
                    @if ($errors->has('search'))
                        <div class="invalid-feedback">
                            {{ $errors->first('search') }}
                        </div>
                    @endif
                </div>
            </form>
            <hr>
        </div>
        <div class="container">
            @if (session('success'))
                <span class="text-success">{{ session('success') }}</span>
            @endif
            <div class="row row-cols-5 gap-3">
                @foreach ($library as $book)
                    @if ($book->quantity > 0)
                        <div class="col border ">
                            <div class="container ">
                                <img src="Cover_images/{{ $book->cover_photo }}" class="border border-3 mt-2"
                                    alt="cover photo" style="max-height: 70px;">
                                <a href="/view-book/{{ $book->id }}">
                                    <p class="text fw-bold">{{ $book->title }}</p>
                                </a>
                                <ul class="list-group list-group-flush list-unstyled">
                                    <li><b>Author</b> :{{ $book->author }}</li>
                                    <li><b>Publisher</b> :{{ $book->publisher }}</li>
                                    <li><b>Genre</b> :{{ $book->genre }}</li>
                                    <li><b>Price</b> :₹ {{ number_format($book->price, 2) }}/-</li>
                                    <li>Actual Price:<span
                                            class="text-decoration-line-through text-danger">₹{{ $book->cost = number_format($book->price * 0.1 + $book->price, 2) }}</span>
                                    </li>
                                </ul>
                                <form action="{{ route('addCart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $book->id }}">
                                    <input type="hidden" name="title" value="{{ $book->title }}">
                                    <input type="hidden" name="price" value="{{ $book->price }}">

                                    <button class="btn btn-primary btn-sm mb-2" type="submit">Add to Cart</button>
                                </form>
                            </div>


                        </div>
                    @endif
                @endforeach

            </div>

        </div>

    </div>
@endsection
