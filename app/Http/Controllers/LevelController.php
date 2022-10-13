<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::latest()->paginate(5);

        return view('levels.index', compact('levels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required',
        ]);

        $input = $request->all();


        Level::create($input);

        return redirect()->route('levels.index')
            ->with('success', 'Level created successfully.');
    }

    public function show(Level $level)
    {
        return view('levels.show', compact('level'));
    }

    public function edit(Level $level)
    {
        return view('levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'level' => 'required',
        ]);

        $input = $request->all();

        $level->update($input);

        return redirect()->route('levels.index')
            ->with('success', 'Level updated successfully');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.index')
            ->with('success', 'Level deleted successfully');
    }
}
