<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
/*
 Afficher la liste des services
 Cette fonction récupère tous les services dans la base
 puis les envoie à la vue services.index
*/
public function index()
{
    // récupérer tous les services dans la base de données
    $services = Service::all();

    // envoyer les services à la vue
    return view('services.index', compact('services'));
}
 /*
    Afficher le formulaire d'ajout d'un service
    Cette fonction ouvre la page contenant le formulaire
    pour créer un nouveau service.
*/

public function create()
{
    // retourner la vue create.blade.php
    return view('services.create');
}
   // Enregistrer un service 
 public function store(Request $request)
{
    $service = new Service();

    $service->nom = $request->nom;
    $service->description = $request->description;

    $service->save();

    return redirect()->route('services.index')
        ->with('success', 'Service ajouté avec succès');
}
/*
 Afficher le formulaire de modification
 Cette fonction récupère le service à modifier
 puis ouvre la page edit avec ses informations
*/

public function edit($id)
{
    // récupérer le service par son id
    $service = Service::findOrFail($id);

    // envoyer les données à la vue
    return view('services.edit', compact('service'));
}
/*
 Mettre à jour un service
 Cette fonction reçoit les nouvelles données
 et met à jour le service dans la base de données
*/
public function update(Request $request, $id)
{
    // récupérer le service
    $service = Service::findOrFail($id);

    // modifier les données
    $service->nom = $request->nom;
    $service->description = $request->description;

    // enregistrer la modification
    $service->save();

    // retour vers la liste
    return redirect()->route('services.index')
    ->with('success', 'Service modifié avec succès');
}
/*
 Supprimer un service
 Cette fonction supprime un service dans la base de données
*/

public function destroy($id)
{
    // récupérer le service
    $service = Service::findOrFail($id);

    // supprimer le service
    $service->delete();

    // retourner vers la liste
    return redirect()->route('services.index')
        ->with('success', 'Service supprimé avec succès');
}
}
