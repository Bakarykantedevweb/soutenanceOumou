<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Poste;

class PosteController extends Controller
{
     public function create()
{
    $services = Service::all();
    return view('postes.create', compact('services'));
}

    /*
    Afficher la liste des postes
    Cette fonction récupère tous les postes dans la base de données
    et les envoie vers la vue postes/index.blade.php
    */
    public function index()
    {
        // récupérer tous les postes
        $postes = Poste::all();

        // retourner la vue avec les données
        return view('postes.index', compact('postes'));
    }
    /*
    Enregistrer un nouveau poste
    Cette fonction récupère les données du formulaire
    puis les enregistre dans la base de données
    */
    public function store(Request $request)
    {

        // validation des données
        $request->validate([
            'nom' => 'required',
            'description' => 'nullable'
        ]);

        // création du poste
       Poste::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'service_id' => $request->service_id
        ]);

        // redirection vers la liste
        return redirect()->route('postes.index')
            ->with('success', 'Poste ajouté avec succès');
    }
    /*
    Afficher le formulaire de modification
    */
    public function edit($id)
    {
        // récupérer le poste
        $poste = Poste::findOrFail($id);

        // envoyer les données à la vue
        return view('postes.edit', compact('poste'));
    }
    /*
    Mettre à jour un poste
    */
    public function update(Request $request, $id)
    {

        // validation
        $request->validate([
            'nom' => 'required',
            'description' => 'nullable'
        ]);

        // récupérer le poste
        $poste = Poste::findOrFail($id);

        // mise à jour
        $poste->update([
            'nom' => $request->nom,
            'description' => $request->description
        ]);

        // retour à la liste
        return redirect()->route('postes.index')
            ->with('success', 'Poste modifié avec succès');
    }
    /*
    Supprimer un poste
    */
    public function destroy($id)
    {
        // récupérer le poste
        $poste = Poste::findOrFail($id);

        // suppression
        $poste->delete();

        // retour à la liste
        return redirect()->route('postes.index')
            ->with('success', 'Poste supprimé avec succès');
    }
    
}