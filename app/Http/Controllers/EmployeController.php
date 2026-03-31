<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Poste;
use App\Models\Employe;
class EmployeController extends Controller
{
  public function index(Request $request)
{
    $search = $request->search;

    $employes = Employe::with(['service', 'poste'])
        ->when($search, function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        })
        ->paginate(5);

    return view('employes.index', compact('employes', 'search'));
}

public function create()
{
    $services = Service::all();
    $postes = Poste::all();

    return view('employes.create', compact('services', 'postes'));
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email',
        'service_id' => 'required',
        'poste_id' => 'required',
        'date_embauche' => 'required'
    ]);
    Employe::create([
    'nom' => $request->nom,
    'prenom' => $request->prenom,
    'email' => $request->email,
    'telephone' => $request->telephone,
    'service_id' => $request->service_id,
    'poste_id' => $request->poste_id,
    'date_embauche' => $request->date_embauche
    ]);
     return redirect()->route('employes.index')
        ->with('success', 'Employé ajouté avec succès');
}
    /*
     Supprimer un employé
    */
    public function destroy($id)
{
    $employe = Employe::findOrFail($id);
    $employe->delete();

    return redirect()->route('employes.index')
        ->with('success', 'Employé supprimé avec succès');
}

    /*
     Mettre à jour un employé
    */
public function update(Request $request, $id)
{
    $employe = Employe::findOrFail($id);

    $employe->update($request->all());

    return redirect()->route('employes.index')
        ->with('success', 'Employé modifié avec succès');
}

/*
    Afficher formulaire modification
*/
public function edit($id)
{
    $employe = Employe::findOrFail($id);
    $services = Service::all();
    $postes = Poste::all();

    return view('employes.edit', compact('employe', 'services', 'postes'));
}
}
