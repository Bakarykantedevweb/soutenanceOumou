@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Rapports & Statistiques</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Rapports</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Total Employés</h5>
                <p class="display-6">{{ $totalEmployees }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Congés enregistrés</h5>
                <p class="display-6">{{ $totalLeaves }}</p>
                <small class="text-muted">{{ $pendingLeaves }} en attente, {{ $approvedLeaves }} approuvés</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Contrats</h5>
                <p class="display-6">{{ $totalContracts }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Recrutements</h6>
                <p class="h3">{{ $totalRecruitments }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Performances</h6>
                <p class="h3">{{ $totalPerformances }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Formations</h6>
                <p class="h3">{{ $totalTrainings }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Paiements</h6>
                <p class="h3">{{ $totalPayments }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Prochaines formations</h5>
                <ul class="list-group list-group-flush">
                    @forelse($upcomingTrainings as $training)
                        <li class="list-group-item px-0">{{ $training->titre }} - {{ $training->date_debut?->format('d/m/Y') ?? 'Date manquante' }}</li>
                    @empty
                        <li class="list-group-item px-0">Aucune formation à venir.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Derniers paiements</h5>
                <ul class="list-group list-group-flush">
                    @forelse($recentPayments as $payment)
                        <li class="list-group-item px-0">{{ $payment->libelle }} - {{ number_format($payment->montant, 2, ',', ' ') }} FCFA</li>
                    @empty
                        <li class="list-group-item px-0">Aucun paiement récent.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
