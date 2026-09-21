@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add Employee</h4>
            </div>

            <div class="card-body">

                <form
                    action="{{ route('employees.store') }}"
                    method="POST"
                >
                    @csrf

                    @include('employees.form', [
                        'buttonText' => 'Save Employee'
                    ])
                </form>

            </div>
        </div>

    </div>
</div>

@endsection