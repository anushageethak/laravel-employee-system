<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('employees.index');
});
Route::resource('employees', EmployeeController::class)
    ->except(['show']);
