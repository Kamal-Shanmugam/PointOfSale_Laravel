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
    {{-- @section('body-content') --}}
        <div class="container d-flex align-items-center flex-column border vh-100 w-75">

            <h2 class="heading border-bottom mt-3">Laravel Login</h2>
            <form action="/login/loginValidate" method="POST">
                @csrf
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

                <div class="container">
                    <button class="btn btn-secondary btn-sm mt-3 ms-5">
                        <a href="/register" class="text-reset text-decoration-none">Register</a>
                    </button>

                    <button class="btn btn-success btn-sm mt-3">Signin</button>
                </div>
            </form>

        </div>
    {{-- @endsection --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
