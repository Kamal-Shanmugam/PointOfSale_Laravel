@extends('layout.Layout')
@section('body-content')
    <div class="container">
        <div class="row d-flex justify-content-center">

            <div class="col col-md-9">

                <table class="table">
                    <thead class="fw-bold ">
                        <tr>
                            <td>#</td>
                            <td>Supplier Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td>Actions</td>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('supplier.delete', $supplier->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this supplier?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>


                </table>
            </div>


            <div class="container col col-md-3">
                <form action="/saveSupplier" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-bold" for="supplier_name">Supplier Name</label>
                        <input type="text" name="supplier_name"
                            class="form-control @if ($errors->has('supplier_name')) {{ 'is-invalid' }} @endif "
                            id="supplier_name" value="{{ old('supplier_name') }}">
                        @if ($errors->has('supplier_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supplier_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" for="email">Email</label>
                        <input type="email" name="email"
                            class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif "
                            id="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" for="phone">Phone</label>
                        <input type="number" name="phone" min="1000000000" max="9999999999"
                            class="form-control @if ($errors->has('phone')) {{ 'is-invalid' }} @endif "
                            id="phone" value="{{ old('phone') }}">
                        @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" for="address">Address</label>
                        <input type="text" name="address"
                            class="form-control @if ($errors->has('address')) {{ 'is-invalid' }} @endif "
                            id="address" value="{{ old('address') }}">
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>

                    {{-- <div class="row"> --}}
                    <button class="btn btn-dark btn-sm " type="reset">Cancel</button>
                    <button class="btn btn-success btn-sm " type="submit">Add</button>
                    {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
