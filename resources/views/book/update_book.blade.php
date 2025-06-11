@extends('layout.Layout')
@section('body-content')
    <div class="container w-50 mt-5" style="height: 65%;">
        <div class="container">
            <h2 class="text text-center">Update the book's details</h2>
        </div>
        <form action="/update-book/{{ $books->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="fw-bold" for="title">Title</label>
                <input type="text" name="title"
                    class="form-control @if ($errors->has('title')) {{ 'is-invalid' }} @endif " id="title"
                    value="{{ old('title', $books->title) }}">
                @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col mb-3">
                    <label class="fw-bold" for="author" class="form-label">Author</label>
                    <input type="text" name="author"
                        class="form-control @if ($errors->has('author')) {{ 'is-invalid' }} @endif " id="author"
                        value="{{ old('author', $books->author) }}">
                    @if ($errors->has('author'))
                        <div class="invalid-feedback">
                            {{ $errors->first('author') }}
                        </div>
                    @endif
                </div>


                <div class="col mb-3">
                    <label class="fw-bold" for="publisher" class="form-label">Publisher</label>
                    <input type="text" name="publisher"
                        class="form-control @if ($errors->has('publisher')) {{ 'is-invalid' }} @endif " id="publisher"
                        value="{{ old('publisher', $books->publisher) }}">
                    @if ($errors->has('publisher'))
                        <div class="invalid-feedback">
                            {{ $errors->first('publisher') }}
                        </div>
                    @endif
                </div>

            </div>

            <div class="row">
                <div class="col mb-3">
                    <label class="fw-bold" for="ISBN" class="form-label">ISBN</label>
                    <input type="number" name="ISBN"
                        class="form-control @if ($errors->has('ISBN')) {{ 'is-invalid' }} @endif " id="ISBN"
                        value="{{ old('ISBN', $books->ISBN) }}">
                    @if ($errors->has('ISBN'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ISBN') }}
                        </div>
                    @endif
                </div>

                <div class="col mb-3">
                    <label class="fw-bold" for="edition" class="form-label">Edition</label>
                    <input type="text" name="edition"
                        class="form-control @if ($errors->has('edition')) {{ 'is-invalid' }} @endif " id="edition"
                        value="{{ old('edition', $books->edition) }}">
                    @if ($errors->has('edition'))
                        <div class="invalid-feedback">
                            {{ $errors->first('edition') }}
                        </div>
                    @endif
                </div>

                <div class="col mb-3">
                    <label class="fw-bold" for="genre" class="form-label">Genre</label>
                    <input type="text" name="genre"
                        class="form-control @if ($errors->has('genre')) {{ 'is-invalid' }} @endif " id="genre"
                        value="{{ old('genre', $books->genre) }}">
                    @if ($errors->has('genre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('genre') }}
                        </div>
                    @endif
                </div>

            </div>
            <div class="row">


                <div class="col mb-3">
                    <label class="fw-bold" for="cost" class="form-label">Cost</label>
                    <input type="text" name="cost"
                        class="form-control @if ($errors->has('cost')) {{ 'is-invalid' }} @endif " id="cost"
                        value="{{ old('cost', $books->cost) }}">
                    @if ($errors->has('cost'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cost') }}
                        </div>
                    @endif
                </div>
                <div class="col mb-3">
                    <label class="fw-bold" for="price" class="form-label">Price</label>
                    <input type="text" name="price"
                        class="form-control @if ($errors->has('price')) {{ 'is-invalid' }} @endif " id="price"
                        value="{{ old('price', $books->price) }}">
                    @if ($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                </div>

                <div class="col mb-3">
                    <label class="fw-bold" for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity"
                        class="form-control @if ($errors->has('quantity')) {{ 'is-invalid' }} @endif " id="quantity"
                        value="{{ old('quantity', $books->quantity) }}">
                    @if ($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <input type="file" name="coverImage" id="coverImage">
                @if ($errors->has('coverImage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coverImage') }}
                    </div>
                @endif
            </div>
            <div class="row w-50 gap-3 d-flex justify-content-end">
                <button class="btn btn-dark btn-sm w-25" type="reset">Cancel</button>
                <button class="btn btn-success btn-sm w-25" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
