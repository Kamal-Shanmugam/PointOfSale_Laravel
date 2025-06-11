<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point of Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/" class="text text-decoration-none text-dark">POS
                    Bill</a></span>
            <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                        <section class="dropdown">
                            <p class=" fw-6  dropdown-toggle border-round" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </p>
                            <ul class="dropdown-menu">
                                @if (in_array( auth()->user()->role , ['Admin', 'Manager']))
                                    <li class="nav-item"><a class="dropdown-item text-tertiary fw-bold"
                                            href="{{ route('employe-Accounts') }}">Users</a></li>
                                @endif
                                <a class="nav-link fw-bold text-danger" href="{{ route('logout') }}">Logout</a>
                            </ul>
                        </section>
                    </li>
                    <li class="nav-item ps-3">
                        <p class="text fw-bold">{{ Auth::user()->username }}</p>
                    </li>

                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @if (in_array(auth()->user()->role, ['Admin', 'Manager']))
                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('library') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('addBook') }}">Add Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('suppliers') }}">Suppliers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('viewCart') }}">CART</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('inventory') }}">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('orderslist') }}">Purchase</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('sales_report.index') }}">Sales Report</a>
                        </li>



                    </ul>
            @endif

            @if (auth()->user()->role === 'User')
                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav">

                        {{-- 
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('addBook') }}">Add Book</a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('library') }}">All Book</a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('suppliers') }}">Suppliers</a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('viewCart') }}">Mycart</a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('inventory') }}">Inventory</a>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('sales_report.index') }}">Sales Report</a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link fw-bold text-danger" href="{{ route('logout') }}">Logout</a>
                        </li>


                    </ul>
            @endif



        </div>
        </div>
    </nav>

    @yield('body-content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
