@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détails du contrat</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contrats</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ul>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-primary">Modifier</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Informations du contrat</h5>
                <p><strong>Agent ID :</strong> {{ $contract->agent_id }}</p>
                <p><strong>Agent :</strong> {{ $contract->employee?->full_name ?? '—' }}</p>
                <p><strong>Numéro de contrat :</strong> {{ $contract->num_contrat }}</p>
                <p><strong>Type de contrat :</strong> {{ $contract->type_contrat }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Détails RH</h5>
                <p><strong>Date début :</strong> {{ optional($contract->date_debut)->format('d/m/Y') }}</p>
                <p><strong>Date fin :</strong> {{ optional($contract->date_fin)->format('d/m/Y') ?? '—' }}</p>
                <p><strong>Salaire de base :</strong> {{ number_format($contract->salaire_base, 0, ',', ' ') }} FCFA</p>
                <p><strong>Situation matrimoniale :</strong> {{ $contract->situation_matrimoniale }}</p>
                <p><strong>Diplôme :</strong> {{ $contract->diplome }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
            <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Supprimer ce contrat ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
