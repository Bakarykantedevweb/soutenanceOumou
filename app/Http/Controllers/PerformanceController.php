<?php

namespace App\Http\Controllers;


use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::latest()->get();
        return view('admin.performances.index', compact('performances'));
    }

    public function create()
    {
        return view('admin.performances.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employe' => 'required|string|max:255',
            'objectif' => 'required|string|max:255',
            'note' => 'nullable|integer',
            'commentaire' => 'nullable|string',
        ]);
        Performance::create($data);
        return redirect()->route('performances.index')->with('success', 'Performance ajoutée !');
    }

    public function show(Performance $performance)
    {
        return view('admin.performances.show', compact('performance'));
    }

    public function edit(Performance $performance)
    {
        return view('admin.performances.edit', compact('performance'));
    }

    public function update(Request $request, Performance $performance)
    {
        $data = $request->validate([
            'employe' => 'required|string|max:255',
            'objectif' => 'required|string|max:255',
            'note' => 'nullable|integer',
            'commentaire' => 'nullable|string',
        ]);
        $performance->update($data);
        return redirect()->route('performances.index')->with('success', 'Performance modifiée !');
    }

    public function destroy(Performance $performance)
    {
        $performance->delete();
        return redirect()->route('performances.index')->with('success', 'Performance supprimée !');
    }
}
