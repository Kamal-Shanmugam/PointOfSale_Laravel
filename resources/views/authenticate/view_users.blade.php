@extends('layout.Layout')
@section('body-content')
    <div class="container">
        <h3 class="text-center text-success my-3">Registered users</h3>

        <div class="container d-flex">

            <table class="table w-50">
                <thead>
                    <tr class="text fw-bold">
                        <td>#</td>
                        <td>UserName</td>
                        <td>E-mail</td>
                        <td>Role</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employess as $employe)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employe->username }}</td>
                            <td>{{ $employe->email }}</td>
                            <td>{{ $employe->role }}</td>
                            <td>
                                <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editroleModal{{ $employe->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <!-- Edit role Modal -->
                                <div class="modal fade" id="editroleModal{{ $employe->id }}" tabindex="-1"
                                    aria-labelledby="editroleModalLabel{{ $employe->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editroleModalLabel{{ $employe->id }}">Edit
                                                    employe
                                                    role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>

                                            </div>
                                            <form action="/role-update/{{ $employe->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="role{{ $employe->id }}" class="form-label">role</label>
                                                        <select name="role" id="role{{ $employe->id }}"
                                                            class="form-select" required>
                                                            <option value="Admin"
                                                                {{ $employe->role == 'Admin' ? 'selected' : '' }}>
                                                                Admin</option>
                                                            <option value="User"
                                                                {{ $employe->role == 'User' ? 'selected' : '' }}>
                                                                User
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

                                <a href="/delete-user/{{ $employe->id }}" class="btn btn-sm btn-danger"><i
                                        class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container w-25">
                <h3 class="text text-center fs-5"> Add New Admin</h3>

                <form action="/account/save-user" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Username</label>
                        <input type="text" name="username"
                            class="form-control @if ($errors->has('username')) {{ 'is-invalid' }} @endif "
                            id="inputUsername" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label ">Email
                            address</label>
                        <input type="text" name="email"
                            class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif "
                            id="inputEmail" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control  @if ($errors->has('password')) {{ 'is-invalid' }} @endif "
                            id="inputPassword" value="{{ old('password') }}">

                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label ">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control 
                    @if ($errors->has('password_confirmation')) {{ 'is-invalid' }} @endif "
                            value="{{ old('password_confirmation') }}" id="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>


                    <select class="form-select @if ($errors->has('role')) {{ 'is-invalid' }} @endif "
                        name="role" value="{{ old('role') }}" aria-label="Default select example">
                        <option selected>Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    @if ($errors->has('role'))
                        <div class="invalid-feedback">
                            {{ $errors->first('role') }}
                        </div>
                    @endif

                    <button type="reset" class="btn btn-dark  mt-3">Cancel</button>
                    <button type="submit" id="register-submit" class="btn btn-primary  mt-3">Submit</button>
                </form>


            </div>
        </div>
    </div>
@endsection
