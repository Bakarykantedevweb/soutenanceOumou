<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Affiche l'interface de pointage (Kiosque)
     */
    public function kiosk()
    {
        return view('attendances.kiosk');
    }

    /**
     * Gère le pointage (Entrée ou Sortie)
     */
    public function punch(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|exists:employees,matricule',
        ]);

        $employee = Employee::where('matricule', $request->matricule)->first();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();
        $currentHour = $now->hour;

        // Chercher si le pointage du jour existe déjà
        $attendance = Attendance::where('employee_id', $employee->id)
                                ->where('date', $today)
                                ->first();

        // 1. Déjà terminé la journée
        if ($attendance && $attendance->check_in && $attendance->check_out) {
            return redirect()->back()->with('error', "Opération impossible. {$employee->first_name}, vous avez déjà terminé votre journée.");
        }

        // 2. Logique pour l'ARRIVÉE (Matin)
        if (!$attendance) {
            if ($currentHour < 6 || $currentHour >= 8) {
                return redirect()->back()->with('error', "Accès refusé. Le pointage d'arrivée est autorisé uniquement entre 06h00 et 08h00.");
            }

            Attendance::create([
                'employee_id' => $employee->id,
                'date' => $today,
                'check_in' => $now->toTimeString(),
                'status' => 'Present', // Puisque c'est forcément avant 08h
            ]);

            return redirect()->back()->with('success', "✅ Bonjour {$employee->first_name} ! Arrivée enregistrée à {$now->format('H:i')}.");
        }

        // 3. Logique pour le DÉPART (Soir)
        if ($attendance->check_in && !$attendance->check_out) {
            if ($currentHour < 16 || $currentHour >= 18) {
                return redirect()->back()->with('error', "Accès refusé. Le pointage de départ est autorisé uniquement entre 16h00 et 18h00.");
            }

            $attendance->update([
                'check_out' => $now->toTimeString(),
            ]);

            return redirect()->back()->with('success', "👋 Au revoir {$employee->first_name} ! Départ enregistré à {$now->format('H:i')}. Bonne soirée !");
        }
    }

    /**
     * Liste des présences pour l'Admin
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->get();
        return view('admin.attendances.index', compact('attendances'));
    }
}
