<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::latest()->paginate(5);
        $collages = Collage::all();

        return view('departments.index', compact(['departments', 'collages']))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $collages = Collage::all();
        return view('departments.create', compact('collages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
            'collage_id' => 'required'
        ]);


        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        $collages = Collage::all();
        foreach ($collages as $key => $col) {
            if ($col->id == $department->collage_id) {
                $collage_name = $col->collage_name;
            }
        }
        return view('departments.show', compact(['department', 'collage_name']));
    }

    public function edit(Department $department)
    {
        $collages = Collage::all();
        $collage_id = $department->collage_id;
        return view('departments.edit', compact(['department', 'collage_id', 'collages']));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'collage_id' => 'required',
            'department_name' => 'required',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
