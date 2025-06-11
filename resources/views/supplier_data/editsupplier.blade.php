@extends('layout.Layout')

@section('body-content')
<div class="container mt-4">
    <h2>Edit Supplier</h2>
    @if ($errors->any())
        <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
    @endif
    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="supplier_name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $supplier->address) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Supplier</button>
        <a href="{{ route('suppliers') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection