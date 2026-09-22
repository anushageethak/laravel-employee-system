<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    $search = trim($request->input('search',''));


        $employees=Employee::query()
            ->when($search !== "", function ($query) use ($search){
                $query->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orwhere('phone', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%");
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
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name'=>['required','string','max:255'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'designation' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'numeric', 'min:0'],
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
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
        return view('employees.edit', compact('employee'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')
                    ->ignore($employee->id),
            ],

            'phone' => ['nullable', 'string', 'max:20'],
            'designation' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'numeric', 'min:0'],
        ]);

        $employee->update($validated);

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
