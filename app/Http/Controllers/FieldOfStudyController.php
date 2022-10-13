<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FieldOfStudy;
use Illuminate\Http\Request;

class FieldOfStudyController extends Controller
{

    public function index()
    {
        $fields = FieldOfStudy::latest()->paginate(5);
        $deps = Department::all();

        return view('fields.index', compact(['fields', 'deps']))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $deps = Department::all();
        return view('fields.create', compact('deps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_of_study' => 'required',
            'dep_id' => 'required'
        ]);


        FieldOfStudy::create($request->all());

        return redirect()->route('fields.index')
            ->with('success', 'Field created successfully.');
    }

    public function show(FieldOfStudy $field)
    {
        $deps = Department::all();
        foreach ($deps as $key => $dep) {
            if ($dep->id == $field->dep_id) {
                $dep_name = $dep->department_name;
            }
        }
        return view('fields.show', compact(['field', 'dep_name']));
    }

    public function edit(FieldOfStudy $field)
    {
        $deps = Department::all();
        $dep_id = $field->dep_id;
        return view('fields.edit', compact(['field', 'dep_id', 'deps']));
    }

    public function update(Request $request, FieldOfStudy $field)
    {
        $request->validate([
            'dep_id' => 'required',
            'field_of_study' => 'required',
        ]);

        $field->update($request->all());

        return redirect()->route('fields.index')
            ->with('success', 'Field updated successfully');
    }

    public function destroy(FieldOfStudy $field)
    {
        $field->delete();

        return redirect()->route('fields.index')
            ->with('success', 'Field deleted successfully');
    }
}
