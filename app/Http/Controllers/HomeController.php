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
        ]);
    }
}
