<?php

namespace App\Http\Controllers;


use App\Models\Recruitment;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index()
    {
        $recruitments = Recruitment::latest()->get();
        return view('admin.recruitments.index', compact('recruitments'));
    }

    public function create()
    {
        return view('admin.recruitments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'poste' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
        ]);
        Recruitment::create($data);
        return redirect()->route('recruitments.index')->with('success', 'Offre ajoutée !');
    }

    public function show(Recruitment $recruitment)
    {
        return view('admin.recruitments.show', compact('recruitment'));
    }

    public function edit(Recruitment $recruitment)
    {
        return view('admin.recruitments.edit', compact('recruitment'));
    }

    public function update(Request $request, Recruitment $recruitment)
    {
        $data = $request->validate([
            'poste' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_limite' => 'nullable|date',
        ]);
        $recruitment->update($data);
        return redirect()->route('recruitments.index')->with('success', 'Offre modifiée !');
    }

    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();
        return redirect()->route('recruitments.index')->with('success', 'Offre supprimée !');
    }
}
