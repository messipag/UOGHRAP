<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollageController extends Controller
{

    public function index()
    {
        $collages = Collage::latest()->paginate(5);

        return view('collages.index', compact('collages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('collages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'collage_name' => 'required',
        ]);

        $input = $request->all();

        $input['created_by'] = Auth()->user()->email;
        $input['updated_by'] = "";

        Collage::create($input);

        return redirect()->route('collages.index')
            ->with('success', 'Collage created successfully.');
    }

    public function show(Collage $collage)
    {
        return view('collages.show', compact('collage'));
    }

    public function edit(Collage $collage)
    {
        return view('collages.edit', compact('collage'));
    }

    public function update(Request $request, Collage $collage)
    {
        $request->validate([
            'collage_name' => 'required',
        ]);

        $input = $request->all();

        // $input['created_by'] = Auth()->user()->email;
        $input['updated_by'] = Auth()->user()->email;


        $collage->update($input);

        return redirect()->route('collages.index')
            ->with('success', 'Collage updated successfully');
    }

    public function destroy(Collage $collage)
    {
        $collage->delete();

        return redirect()->route('collages.index')
            ->with('success', 'Collage deleted successfully');
    }
}
