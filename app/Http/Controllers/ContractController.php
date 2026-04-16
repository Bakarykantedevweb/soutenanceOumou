<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $num_contrat = $this->generateContractNumber();

        return view('admin.contracts.create', compact('employees', 'diplomes', 'num_contrat'));
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

        $numContrat = $request->input('num_contrat') ?: $this->generateContractNumber();
        while (Contract::where('num_contrat', $numContrat)->exists()) {
            $numContrat = $this->generateContractNumber();
        }

        Contract::create([
            'agent_id' => $request->agent_id,
            'num_contrat' => $numContrat,
            'type_contrat' => $request->type_contrat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->type_contrat === 'CDI' ? null : $request->date_fin,
            'salaire_base' => $request->salaire_base,
            'situation_matrimoniale' => $request->situation_matrimoniale,
            'diplome' => $request->diplome,
        ]);

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

        $contract->update([
            'agent_id' => $request->agent_id,
            'num_contrat' => $request->num_contrat,
            'type_contrat' => $request->type_contrat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->type_contrat === 'CDI' ? null : $request->date_fin,
            'salaire_base' => $request->salaire_base,
            'situation_matrimoniale' => $request->situation_matrimoniale,
            'diplome' => $request->diplome,
        ]);

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

    private function generateContractNumber(): string
    {
        $lastNumber = Contract::query()
            ->select(DB::raw('CAST(num_contrat AS UNSIGNED) AS num'))
            ->orderByDesc('num')
            ->value('num');

        $next = $lastNumber ? ((int) $lastNumber + 1) : 1;

        return (string) $next;
    }
}
