<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(10);
        return view('department.index', compact('departments'));
    }

    public function update(Department $department)
    {
        $department->update(request()->all());
        return back()->with("status", __('Updated'));
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with("status", __('Deleted'));
    }
}
