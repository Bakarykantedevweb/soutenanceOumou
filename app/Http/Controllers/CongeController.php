<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Conge;

class CongeController extends Controller
{
    public function index()
{
    $conges = Conge::with('employe')->paginate(5);

    return view('conges.index', compact('conges'));
}

public function create()
{
    $employes = Employe::all();

    return view('conges.create', compact('employes'));
}

public function store(Request $request)
{
    Conge::create($request->all());

    return redirect()->route('conges.index')
        ->with('success', 'Congé ajouté avec succès');
}

public function edit($id)
{
    $conge = Conge::findOrFail($id);
    $employes = Employe::all();

    return view('conges.edit', compact('conge', 'employes'));
}

public function update(Request $request, $id)
{
    $conge = Conge::findOrFail($id);

    $conge->update($request->all());

    return redirect()->route('conges.index')
        ->with('success', 'Congé modifié avec succès');
}

public function destroy($id)
{
    $conge = Conge::findOrFail($id);
    $conge->delete();

    return redirect()->route('conges.index')
        ->with('success', 'Congé supprimé avec succès');
}
}
