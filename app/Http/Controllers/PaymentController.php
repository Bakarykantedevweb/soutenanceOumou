<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('employee')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $employees = Employee::orderBy('first_name')->get();
        return view('admin.payments.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'libelle' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'status' => 'required|string|in:Payé,En attente,Annulé',
            'description' => 'nullable|string',
        ]);

        Payment::create($data);

        return redirect()->route('payments.index')->with('success', 'Paiement enregistré !');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $employees = Employee::orderBy('first_name')->get();
        return view('admin.payments.edit', compact('payment', 'employees'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'libelle' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'status' => 'required|string|in:Payé,En attente,Annulé',
            'description' => 'nullable|string',
        ]);

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Paiement mis à jour !');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Paiement supprimé !');
    }
}
