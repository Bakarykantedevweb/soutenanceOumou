<?php

namespace App\Http\Controllers;
use App\Models\Presence;
use App\Models\Employe;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
{
    $presences = Presence::with('employe')->get();

    return view('presences.index', compact('presences'));
}

public function create()
{
    $employes = Employe::all();

    return view('presences.create', compact('employes'));
}

public function store(Request $request)
{
    $request->validate([
        'employe_id' => 'required',
        'date' => 'required'
    ]);

    Presence::create($request->all());

    return redirect()->route('presences.index')
        ->with('success', 'Présence ajoutée avec succès');
}

public function destroy($id)
{
    $presence = Presence::findOrFail($id);
    $presence->delete();

    return redirect()->route('presences.index')
        ->with('success', 'Supprimé');
}
}
