<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $leaves = Leave::with('employee')->latest()->paginate(12);
        } else {
            $leaves = Leave::where('employee_id', Auth::user()->employee_id)->latest()->paginate(12);
        }

        return view('admin.leaves.index', compact('leaves'));
    }

    public function create()
    {
        if (Auth::user()->isAdmin()) {
            $employees = Employee::orderBy('last_name')->get();
        } else {
            $employees = Employee::where('id', Auth::user()->employee_id)->get();
        }

        return view('admin.leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $employee_id = Auth::user()->isAdmin() ? $request->employee_id : Auth::user()->employee_id;

        $request->validate([
            'type' => 'required|string|max:80',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:1000',
        ]);

        Leave::create([
            'employee_id' => $employee_id,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'En attente',
            'reason' => $request->reason,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Votre demande de congé a été enregistrée et est en attente de validation.');
    }

    public function edit(Leave $leave)
    {
        $employees = Employee::orderBy('last_name')->get();

        return view('admin.leaves.edit', compact('leave', 'employees'));
    }

    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string|max:80',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|max:50',
            'reason' => 'nullable|string|max:1000',
        ]);

        $leave->update($request->only([
            'employee_id',
            'type',
            'start_date',
            'end_date',
            'status',
            'reason',
        ]));

        return redirect()->route('leaves.index')->with('success', 'Demande de congé mise à jour.');
    }

    public function show(Leave $leave)
    {
        $leave->load('employee');

        return view('admin.leaves.show', compact('leave'));
    }

    public function approve(Leave $leave)
    {
        abort_if(!Auth::user()->isAdmin(), 403);

        if ($leave->status !== 'En attente') {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $leave->update(['status' => 'Approuvé']);

        return back()->with('success', 'Demande de congé approuvée.');
    }

    public function reject(Leave $leave)
    {
        abort_if(!Auth::user()->isAdmin(), 403);

        if ($leave->status !== 'En attente') {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $leave->update(['status' => 'Refusé']);

        return back()->with('success', 'Demande de congé refusée.');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'Demande de congé supprimée.');
    }
}
