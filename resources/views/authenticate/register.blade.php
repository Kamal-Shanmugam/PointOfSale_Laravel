<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point of Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex align-items-center flex-column border vh-100 w-75">
        <h2 class="heading border-bottom mt-3">Laravel Registration</h2>

        <form action="/register/RegValidate" method="POST">
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
                    class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif " id="inputEmail"
                    value="{{ old('email') }}">
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


            <select class="form-select @if ($errors->has('role')) {{ 'is-invalid' }} @endif " name="role"
                value="{{ old('role') }}" hidden     aria-label="Default select example">
                <option >Role</option>
                <option value="Admin">Admin</option>
                <option value="User" selected>User</option>
            </select>
            @if ($errors->has('role'))
                <div class="invalid-feedback">
                    {{ $errors->first('role') }}
                </div>
            @endif

            <a href="{{ route('login') }}" class="btn btn-dark  mt-3">Cancel</a>
            <button type="submit" id="register-submit" class="btn btn-primary  mt-3">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
