@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Employee</h4>
            </div>

            <div class="card-body">

                <form
                    action="{{ route('employees.update', $employee) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    @include('employees.form', [
                        'buttonText' => 'Update Employee'
                    ])
                </form>

            </div>
        </div>

    </div>
</div>

@endsection