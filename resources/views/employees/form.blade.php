@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please correct the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="mb-3">
    <label for="department_id" class="form-label">
        Department
    </label>

    <select
        id="department_id"
        name="department_id"
        class="form-select"
        required
    >
        <option value="">Select Department</option>

        @foreach ($departments as $department)
            <option
                value="{{ $department->id }}"
                @selected(
                    old(
                        'department_id',
                        $employee->department_id ?? ''
                    ) == $department->id
                )
            >
                {{ $department->name }}
            </option>
        @endforeach
    </select>

    @error('department_id')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    
    <label for="name" class="form-label">
        Name
    </label>

    <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $employee->name ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="email" class="form-label">
        Email
    </label>

    <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        value="{{ old('email', $employee->email ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="phone" class="form-label">
        Phone
    </label>

    <input
        type="text"
        id="phone"
        name="phone"
        class="form-control"
        value="{{ old('phone', $employee->phone ?? '') }}"
    >
</div>

<div class="mb-3">
    <label for="designation" class="form-label">
        Designation
    </label>

    <input
        type="text"
        id="designation"
        name="designation"
        class="form-control"
        value="{{ old('designation', $employee->designation ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label for="salary" class="form-label">
        Salary
    </label>

    <input
        type="number"
        id="salary"
        name="salary"
        class="form-control"
        step="0.01"
        min="0"
        value="{{ old('salary', $employee->salary ?? '') }}"
        required
    >
</div>

<button type="submit" class="btn btn-success">
    {{ $buttonText }}
</button>

<a
    href="{{ route('employees.index') }}"
    class="btn btn-secondary"
>
    Cancel
</a>