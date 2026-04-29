<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('last_name')->paginate(12);

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create', [
            'departments' => $this->getDepartmentOptions(),
            'positions' => $this->getPositionOptions(),
            'matricule' => Employee::generateMatricule(),
            'num_contrat' => Contract::generateContractNumber(),
            'contract_types' => $this->getContractTypeOptions(),
            'marital_statuses' => $this->getMaritalStatusOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // Employé
            'matricule' => 'nullable|string|max:100|unique:employees,matricule',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'date_naissance' => 'required|date|before:today',
            'phone' => 'nullable|string|max:30',
            'department' => 'nullable|string|in:' . implode(',', $this->getDepartmentOptions()),
            'position' => 'nullable|string|in:' . implode(',', $this->getPositionOptions()),
            'hired_at' => 'required|date',
            
            // Contrat
            'type_contrat' => 'required|string|in:' . implode(',', $this->getContractTypeOptions()),
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire_base' => 'required|numeric|min:0',
            'situation_matrimoniale' => 'required|string|in:' . implode(',', $this->getMaritalStatusOptions()),
            'diplome' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $employeeData = $request->only([
                'matricule', 'first_name', 'last_name', 'email', 
                'date_naissance', 'phone', 'department', 'position', 'hired_at'
            ]);

            if (empty($employeeData['matricule'])) {
                $employeeData['matricule'] = Employee::generateMatricule();
            }

            $employee = Employee::create($employeeData);

            $contractData = $request->only([
                'type_contrat', 'date_debut', 'date_fin', 
                'salaire_base', 'situation_matrimoniale', 'diplome'
            ]);
            
            $contractData['agent_id'] = $employee->id;
            $contractData['num_contrat'] = Contract::generateContractNumber();

            $contract = Contract::create($contractData);

            DB::commit();

            return redirect()->route('contracts.pdf', $contract->id)
                ->with('success', 'Employé et contrat créés avec succès ! Imprimez ou enregistrez le PDF ci-dessous.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', [
            'employee' => $employee,
            'departments' => $this->getDepartmentOptions(),
            'positions' => $this->getPositionOptions(),
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'matricule' => 'required|string|max:100|unique:employees,matricule,' . $employee->id,
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'date_naissance' => 'required|date|before:today',
            'phone' => 'nullable|string|max:30',
            'department' => 'nullable|string|in:' . implode(',', $this->getDepartmentOptions()),
            'position' => 'nullable|string|in:' . implode(',', $this->getPositionOptions()),
            'hired_at' => 'required|date',
            'role' => 'nullable|string|in:admin,user',
            'password' => 'nullable|string|min:8',
        ]);

        $employee->update($request->only([
            'matricule',
            'first_name',
            'last_name',
            'email',
            'date_naissance',
            'phone',
            'department',
            'position',
            'hired_at',
        ]));

        // Gérer le compte utilisateur lié
        $user = \App\Models\User::where('employee_id', $employee->id)->first();
        
        if ($request->filled('role')) {
            if (!$user) {
                // Création si n'existe pas
                \App\Models\User::create([
                    'nom' => $employee->last_name,
                    'prenom' => $employee->first_name,
                    'email' => $employee->email,
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password ?? 'password'),
                    'role' => $request->role,
                    'employee_id' => $employee->id
                ]);
            } else {
                // Mise à jour si existe
                $userData = [
                    'email' => $employee->email,
                    'role' => $request->role,
                    'nom' => $employee->last_name,
                    'prenom' => $employee->first_name,
                ];
                if ($request->filled('password')) {
                    $userData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
                }
                $user->update($userData);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Employé et compte utilisateur mis à jour avec succès.');
    }

    public function show(Employee $employee)
    {
        $employee->load('contracts');
        return view('admin.employees.show', compact('employee'));
    }

    public function showBadge(Employee $employee)
    {
        return view('admin.employees.badge', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }

    private function getDepartmentOptions(): array
    {
        return [
            'Ressources Humaines',
            'Finance',
            'Marketing',
            'Informatique',
            'Production',
            'Qualité',
            'Ventes',
            'Opérations',
        ];
    }

    private function getPositionOptions(): array
    {
        return [
            'Manager',
            'Analyste',
            'Développeur',
            'Assistant RH',
            'Comptable',
            'Technicien',
            'Chargé de recrutement',
            'Responsable paie',
        ];
    }

    private function getContractTypeOptions(): array
    {
        return [
            'CDI',
            'CDD',
            'Stage',
            'Apprentissage',
            'Prestataire',
        ];
    }

    private function getMaritalStatusOptions(): array
    {
        return [
            'Célibataire',
            'Marié(e)',
            'Divorcé(e)',
            'Veuf/Veuve',
        ];
    }
}
