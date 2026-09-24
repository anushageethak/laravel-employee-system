<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    $search = trim($request->input('search',''));


        $employees=Employee::query()
        ->with('department')
            ->when($search !== "", function ($query) use ($search){
                $query->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orwhere('phone', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                });
            })
        ->latest()
        ->paginate(5)
        ->WithQueryString();


        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // $validated= $request->validate([
        //     'department_id'=>['required','exists:departments,id'],
        //     'name'=>['required','string','max:255'],
        //     'email' => ['required', 'email', 'unique:employees,email'],
        //     'phone' => ['nullable', 'string', 'max:20'],
        //     'designation' => ['required', 'string', 'max:255'],
        //     'salary' => ['required', 'numeric', 'min:0'],
        // ]);
        // Employee::create($validated);

        Employee ::create($request->validated());

        return redirect()
        ->route('employees.index')
        ->with('success', 'Employee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        // return view('employees.edit', compact('employee'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'departments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // $validated = $request->validate([
        //     'department_id' => [
        //     'required',
        //     'exists:departments,id'
        // ],
        //     'name' => ['required', 'string', 'max:255'],

        //     'email' => [
        //         'required',
        //         'email',
        //         Rule::unique('employees', 'email')
        //             ->ignore($employee->id),
        //     ],

        //     'phone' => ['nullable', 'string', 'max:20'],
        //     'designation' => ['required', 'string', 'max:255'],
        //     'salary' => ['required', 'numeric', 'min:0'],
        // ]);

        $employee->update($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
         $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    
    }
}
