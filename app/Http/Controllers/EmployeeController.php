<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

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
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:30',
            'department' => 'nullable|string|in:' . implode(',', $this->getDepartmentOptions()),
            'position' => 'nullable|string|in:' . implode(',', $this->getPositionOptions()),
            'status' => 'required|string|max:50',
            'hired_at' => 'required|date',
            'salary' => 'nullable|numeric|min:0',
        ]);

        Employee::create($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'department',
            'position',
            'status',
            'hired_at',
            'salary',
        ]));

        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès.');
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:30',
            'department' => 'nullable|string|in:' . implode(',', $this->getDepartmentOptions()),
            'position' => 'nullable|string|in:' . implode(',', $this->getPositionOptions()),
            'status' => 'required|string|max:50',
            'hired_at' => 'required|date',
            'salary' => 'nullable|numeric|min:0',
        ]);

        $employee->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'department',
            'position',
            'status',
            'hired_at',
            'salary',
        ]));

        return redirect()->route('employees.index')->with('success', 'Employé mis à jour avec succès.');
    }

    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
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
}
