<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('employee')->latest()->paginate(12);

        return view('admin.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $employees = Employee::orderBy('last_name')->get();
        $diplomes = $this->diplomeOptions();

        return view('admin.contracts.create', compact('employees', 'diplomes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:employees,id',
            'num_contrat' => 'required|string|max:100|unique:contracts,num_contrat',
            'type_contrat' => 'required|string|max:100',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire_base' => 'required|numeric|min:0',
            'situation_matrimoniale' => 'required|string|max:100',
            'diplome' => 'required|string|max:255',
        ]);

        Contract::create($request->only([
            'agent_id',
            'num_contrat',
            'type_contrat',
            'date_debut',
            'date_fin',
            'salaire_base',
            'situation_matrimoniale',
            'diplome',
        ]));

        return redirect()->route('contracts.index')->with('success', 'Contrat ajouté avec succès.');
    }

    public function show(Contract $contract)
    {
        $contract->load('employee');

        return view('admin.contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $employees = Employee::orderBy('last_name')->get();
        $diplomes = $this->diplomeOptions();

        return view('admin.contracts.edit', compact('contract', 'employees', 'diplomes'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'agent_id' => 'required|exists:employees,id',
            'num_contrat' => 'required|string|max:100|unique:contracts,num_contrat,' . $contract->id,
            'type_contrat' => 'required|string|max:100',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire_base' => 'required|numeric|min:0',
            'situation_matrimoniale' => 'required|string|max:100',
            'diplome' => 'required|string|max:255',
        ]);

        $contract->update($request->only([
            'agent_id',
            'num_contrat',
            'type_contrat',
            'date_debut',
            'date_fin',
            'salaire_base',
            'situation_matrimoniale',
            'diplome',
        ]));

        return redirect()->route('contracts.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Contrat supprimé avec succès.');
    }

    private function diplomeOptions(): array
    {
        return [
            'Baccalauréat',
            'BTS',
            'DUT',
            'Licence professionnelle',
            'Licence',
            'Master',
            'Ingénieur',
            'MBA',
            'Doctorat',
        ];
    }
}
