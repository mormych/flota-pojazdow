<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>System zarządzania flotą</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('vehicles.index') }}">
            Flota pojazdów
        </a>

        @auth
            <div class="d-flex align-items-center gap-3">

                <span class="text-white">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf

                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Wyloguj
                    </button>
                </form>

            </div>
        @endauth

    </div>
</nav>



<div class="container mt-4">

    @yield('content')

</div>



</body>

</html>