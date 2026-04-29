@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Registre des Présences</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Présences</li>
            </ul>
        </div>
        <div class="col-auto float-end ms-auto">
            <a href="{{ route('attendances.kiosk') }}" target="_blank" class="btn btn-primary">
                <i class="ti ti-device-display"></i> Ouvrir le Kiosque de Pointage
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Employé</th>
                        <th>Matricule</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Statut</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->date->format('d/m/Y') }}</td>
                        <td>{{ $attendance->employee->full_name }}</td>
                        <td><span class="badge bg-secondary">{{ $attendance->employee->matricule }}</span></td>
                        <td><span class="text-success fw-bold">{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '--:--' }}</span></td>
                        <td><span class="text-danger fw-bold">{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '--:--' }}</span></td>
                        <td>
                            @if($attendance->status == 'Present')
                                <span class="badge bg-success">Présent</span>
                            @elseif($attendance->status == 'Late')
                                <span class="badge bg-warning text-dark">En retard</span>
                            @else
                                <span class="badge bg-danger">{{ $attendance->status }}</span>
                            @endif
                        </td>
                        <td>{{ $attendance->note ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Aucun pointage enregistré pour le moment.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
