<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Absence;
class AbsenceController extends Controller
{
    public function index()
{
    // Charger les employés avec absence
    $absences = Absence::with('employe')->get();

    return view('absences.index', compact('absences'));
}

public function create()
{
    // Liste des employés pour le select
    $employes = Employe::all();

    return view('absences.create', compact('employes'));
}

public function store(Request $request)
{
    // Validation simple
    $request->validate([
    'employe_id' => 'required',
    'date_absence' => 'required'
]);
    // Création absence
    Absence::create($request->all());

    return redirect()->route('absences.index')
        ->with('success', 'Absence ajoutée avec succès');
}

public function destroy($id)
{
    $absence = Absence::findOrFail($id);
    $absence->delete();

    return redirect()->route('absences.index')
        ->with('success', 'Absence supprimée');
}
}
