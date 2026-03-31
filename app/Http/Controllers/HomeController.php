<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employe;
use App\Models\Service;
use App\Models\Poste;
use App\Models\Absence;
use App\Models\Conge;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
{
    // Totaux
    $employes = Employe::count();
    $services = Service::count();
    $postes = Poste::count();
    $absences = Absence::count();
    $conges = Conge::count();
    $presences = Presence::count();

    // Employés par service
    $employesParService = DB::table('employes')
        ->join('services', 'employes.service_id', '=', 'services.id')
        ->select('services.nom', DB::raw('count(*) as total'))
        ->groupBy('services.nom')
        ->get();

    // Absences du mois
    $absencesMois = Absence::whereMonth('date_absence', Carbon::now()->month)
        ->count();

    // Présences du jour
    $presencesJour = Presence::whereDate('date', Carbon::today())
        ->count();

    return view('home', compact(
        'employes',
        'services',
        'postes',
        'absences',
        'conges',
        'presences',
        'employesParService',
        'absencesMois',
        'presencesJour'
    ));
}
    public function __construct()
    {
        $this->middleware('auth');
    }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
