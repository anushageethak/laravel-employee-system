@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Employees</h2>

    <a
        href="{{ route('employees.create') }}"
        class="btn btn-primary"
    >
        Add Employee
    </a>
</div>
<form
    action="{{ route('employees.index') }}"
    method="GET"
    class="row g-2 mb-4"
>
    <div class="col-md-8">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search name, email, phone or designation"
            value="{{ $search }}"
        >
    </div>

    <div class="col-md-4">
        <button type="submit" class="btn btn-primary">
            Search
        </button>

        <a
            href="{{ route('employees.index') }}"
            class="btn btn-secondary"
        >
            Clear
        </a>
    </div>
</form>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($employees as $employee)

                        <tr>
                            <td>{{ $employee->id }}</td>

                            <td>{{ $employee->name }}</td>

                            <td>
                                {{ $employee->department?->name ?? 'Not assigned' }}
                            </td>

                            <td>{{ $employee->email }}</td>

                            <td>
                                {{ $employee->phone ?? 'Not provided' }}
                            </td>

                            <td>{{ $employee->designation }}</td>

                            <td>
                                ₹{{ number_format($employee->salary, 2) }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('employees.edit', $employee) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('employees.destroy', $employee) }}"
                                    method="POST"
                                    class="d-inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this employee?')"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center">
                                @if ($search !== '')
                                    No employees found for "{{ $search }}".
                                @else
                                    No employees found.
                                @endif                            
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
            <div class="mt-4">
                {{ $employees->links() }}
            </div>
        </div>

    </div>
</div>

@endsection