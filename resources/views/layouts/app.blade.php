<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Employee Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a
                href="{{ auth()->check()
                    ? route('employees.index')
                    : route('login') }}"
                class="navbar-brand"
            >
                Employee System
            </a>

            <div class="d-flex align-items-center gap-3">

                @auth
                    <span class="text-white">
                        Welcome, {{ auth()->user()->name }}
                    </span>

                    <a
                        href="{{ route('employees.index') }}"
                        class="btn btn-outline-light btn-sm"
                    >
                        Employees
                    </a>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="m-0"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                        >
                            Logout
                        </button>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="btn btn-outline-light btn-sm"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="btn btn-primary btn-sm"
                    >
                        Register
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    <main class="container py-5">
        @yield('content')
    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>