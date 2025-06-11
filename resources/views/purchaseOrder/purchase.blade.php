@extends('layout.Layout')
@section('body-content')
    <div class="container w-50">
        <nav class="navbar navbar-expand-lg  mt-1  ">
            <div class="container-fluid">

                <span class="navbar-brand mb-0 ms-5  h1">
                    <a href="/" class="text text-decoration-none text-dark">Order new books</a>
                </span>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            {{-- <a class="nav-link fw-bold border" href="{{ route('purchase') }}">New Purchase</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @if (session('success'))
                <span class="text-success">{{ session('success') }}</span>
            @endif
        </div>



        <form action="{{ route('save_purchase') }}" method="post">

            @csrf




            <select class="form-select col mb-3 @if ($errors->has('booktitle')) {{ 'is-invalid' }} @endif "
                name="booktitle" value="{{ old('booktitle') }}" aria-label="Default select example">
                <option selected>Book Name</option>
                @foreach ($library as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
            @if ($errors->has('booktitle'))
                <div class="invalid-feedback">
                    {{ $errors->first('booktitle') }}
                </div>
            @endif

            <select class="form-select col mb-3 @if ($errors->has('supplier')) {{ 'is-invalid' }} @endif "
                name="supplier" value="{{ old('supplier') }}" aria-label="Default select example">
                <option selected>supplier Name</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
            @if ($errors->has('supplier'))
                <div class="invalid-feedback">
                    {{ $errors->first('supplier') }}
                </div>
            @endif



            <select class="form-select col mb-3 @if ($errors->has('status')) {{ 'is-invalid' }} @endif "
                name="status" value="{{ old('status') }}" aria-label="Default select example" hidden>

                <option selected value="Processing">Processing</option>
                <option value="Received">Received</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            @if ($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
            @endif




            <div class="mb-3 col">
                {{-- <label for="cost" class="form-label">Cost Per Book</label> --}}
                <input type="text" name="cost" placeholder="Rs." hidden
                    class="form-control @if ($errors->has('cost')) {{ 'is-invalid' }} @endif " id="cost"
                    value="{{ old('cost') }}">
                @if ($errors->has('cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost') }}
                    </div>
                @endif
            </div>


            <div class="mb-3 col">
                <label for="quantity" class="form-label">quantity</label>
                <input type="number" name="quantity" min="1"
                    class="form-control @if ($errors->has('quantity')) {{ 'is-invalid' }} @endif " id="quantity"
                    value="{{ old('quantity') }}">
                @if ($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
            </div>

            {{-- PO DAte  --}}


            {{-- <div class="mb-3">
                <label for="po_date" class="form-label">Purchase Date</label>
                <input type="date" name="po_date"
                    class="form-control @if ($errors->has('po_date')) {{ 'is-invalid' }} @endif " id="po_date"
                    value="{{ old('po_date') }}">
                @if ($errors->has('po_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('po_date') }}
                    </div>
                @endif
            </div> --}}


            {{-- Expected delivery date  --}}
            <div class="mb-3">
                <label for="ed_date" class="form-label">Expected delivery Date</label>
                <input type="date" name="ed_date"
                    class="form-control @if ($errors->has('ed_date')) {{ 'is-invalid' }} @endif " id="ed_date"
                    value="{{ old('ed_date') }}">
                @if ($errors->has('ed_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ed_date') }}
                    </div>
                @endif
            </div>

            <button class="btn btn-secondary" type="reset">cancel</button>
            <button class="btn btn-success" type="submit">Order Now</button>
    </div>

    </form>
    </div>
@endsection
