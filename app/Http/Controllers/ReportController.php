<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Performance;
use App\Models\Recruitment;
use App\Models\Training;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', [
            'totalEmployees' => Employee::count(),
            'totalLeaves' => Leave::count(),
            'totalContracts' => Contract::count(),
            'totalRecruitments' => Recruitment::count(),
            'totalPerformances' => Performance::count(),
            'totalTrainings' => Training::count(),
            'totalPayments' => Payment::count(),
            'pendingLeaves' => Leave::where('status', 'En attente')->count(),
            'approvedLeaves' => Leave::where('status', 'Approuvé')->count(),
            'upcomingTrainings' => Training::where('date_debut', '>=', now())->orderBy('date_debut')->limit(5)->get(),
            'recentPayments' => Payment::with('employee')->latest()->limit(5)->get(),
            'todayAttendance' => Attendance::whereDate('date', now())->count(),
        ]);
    }
}
