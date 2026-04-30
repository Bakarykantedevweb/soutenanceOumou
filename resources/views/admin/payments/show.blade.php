@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détail du paiement</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Paiements</a></li>
                <li class="breadcrumb-item active">Détail</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-3">{{ $payment->libelle }}</h4>
        <p><strong>Employé :</strong> {{ $payment->employee?->full_name ?? 'N/A' }}</p>
        <p><strong>Montant :</strong> {{ number_format($payment->montant, 2, ',', ' ') }} FCFA</p>
        <p><strong>Date :</strong> {{ $payment->date_paiement ? $payment->date_paiement->format('d/m/Y') : 'Non définie' }}</p>
        <p><strong>Statut :</strong> {{ $payment->status }}</p>
        <div class="mb-3">
            <h6>Description</h6>
            <p>{{ $payment->description ?? 'Aucune description.' }}</p>
        </div>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection
