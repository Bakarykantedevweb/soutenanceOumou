<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // Si c'est l'Admin, on garde la logique globale
        if ($user->isAdmin()) {
            $departmentStats = Employee::select('department', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('department')
                ->get();

            return view('admin.index', [
                'employeeCount' => Employee::count(),
                'leaveCount' => Leave::count(),
                'contractCount' => Contract::count(),
                'pendingLeaves' => Leave::where('status', 'En attente')->count(),
                'approvedLeaves' => Leave::where('status', 'Approuvé')->count(),
                'rejectedLeaves' => Leave::where('status', 'Refusé')->count(),
                'recentEmployees' => Employee::latest()->limit(5)->get(),
                'recentLeaves' => Leave::with('employee')->latest()->limit(5)->get(),
                'todayAttendances' => Attendance::whereDate('date', now())->count(),
                'chartLabels' => $departmentStats->pluck('department')->toArray(),
                'chartData' => $departmentStats->pluck('total')->toArray(),
            ]);
        }

        // Si c'est un Employé, on prépare ses données perso
        $employee = $user->employee;
        return view('admin.index', [
            'employeeCount' => Employee::count(),
            'leaveCount' => Leave::count(),
            'contractCount' => Contract::count(),
            'pendingLeaves' => Leave::where('status', 'En attente')->count(),
            'approvedLeaves' => Leave::where('status', 'Approuvé')->count(),
            'rejectedLeaves' => Leave::where('status', 'Refusé')->count(),
            'recentEmployees' => Employee::latest()->limit(5)->get(),
            'recentLeaves' => Leave::with('employee')->latest()->limit(5)->get(),
            'recentContracts' => Contract::with('employee')->latest()->limit(5)->get(),
            'todayAttendances' => Attendance::whereDate('recorded_at', now())->count(),
            'expiringContracts' => Contract::with('employee')
                ->whereNotNull('date_fin')
                ->whereBetween('date_fin', [now(), now()->addDays(30)])
                ->orderBy('date_fin')
                ->get(),
            'myLeavesCount' => Leave::where('employee_id', $user->employee_id)->count(),
            'myPendingLeaves' => Leave::where('employee_id', $user->employee_id)->where('status', 'En attente')->count(),
            'myApprovedLeaves' => Leave::where('employee_id', $user->employee_id)->where('status', 'Approuvé')->count(),
            'myAttendances' => Attendance::where('employee_id', $user->employee_id)->latest()->limit(5)->get(),
            'todayAttendance' => Attendance::where('employee_id', $user->employee_id)->whereDate('date', now())->first(),
            'employee' => $employee

        ]);
    }
}
