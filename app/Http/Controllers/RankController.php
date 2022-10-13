<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        $ranks = Rank::latest()->paginate(5);

        return view('ranks.index', compact('ranks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('ranks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rank' => 'required',
        ]);

        $input = $request->all();


        Rank::create($input);

        return redirect()->route('ranks.index')
            ->with('success', 'Rank created successfully.');
    }

    public function show(Rank $rank)
    {
        return view('ranks.show', compact('rank'));
    }

    public function edit(Rank $rank)
    {
        return view('ranks.edit', compact('rank'));
    }

    public function update(Request $request, Rank $rank)
    {
        $request->validate([
            'rank' => 'required',
        ]);

        $input = $request->all();

        $rank->update($input);

        return redirect()->route('ranks.index')
            ->with('success', 'Rank updated successfully');
    }

    public function destroy(Rank $rank)
    {
        $rank->delete();

        return redirect()->route('ranks.index')
            ->with('success', 'Rank deleted successfully');
    }
}
