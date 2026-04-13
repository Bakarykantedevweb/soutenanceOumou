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
        $leaves = Leave::with('employee')->latest()->paginate(12);

        return view('admin.leaves.index', compact('leaves'));
    }

    public function create()
    {
        $employees = Employee::orderBy('last_name')->get();

        return view('admin.leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string|max:80',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|max:50',
            'reason' => 'nullable|string|max:1000',
        ]);

        Leave::create($request->only([
            'employee_id',
            'type',
            'start_date',
            'end_date',
            'status',
            'reason',
        ]));

        return redirect()->route('leaves.index')->with('success', 'Demande de congé enregistrée.');
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
