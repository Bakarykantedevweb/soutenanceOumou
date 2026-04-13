<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('first_name')->get();
        $attendances = Attendance::with('employee')->latest()->paginate(12);

        return view('admin.attendances.index', compact('employees', 'attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|in:in,out',
            'note' => 'nullable|string|max:255',
        ]);

        Attendance::create([
            'employee_id' => $request->employee_id,
            'type' => $request->type,
            'recorded_at' => now(),
            'note' => $request->note,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Pointage enregistré avec succès.');
    }
}
