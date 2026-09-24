@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Login</h4>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('login.store') }}"
                    method="POST"
                >
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="form-check-input"
                        >

                        <label
                            for="remember"
                            class="form-check-label"
                        >
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a
                        href="{{ route('register') }}"
                        class="btn btn-link"
                    >
                        Create an account
                    </a>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection