@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détails de la demande de congé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Congés</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ul>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-primary">Modifier</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Informations de la demande</h5>
                <p><strong>Employé :</strong> {{ $leave->employee?->full_name ?? '—' }}</p>
                <p><strong>Type de congé :</strong> {{ $leave->type }}</p>
                <p><strong>Période :</strong> {{ optional($leave->start_date)->format('d/m/Y') }} – {{ optional($leave->end_date)->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Statut de la demande</h5>
                <p><strong>Statut :</strong> {{ $leave->status }}</p>
                <p><strong>Motif :</strong> {{ $leave->reason ?? '—' }}</p>
                <p><strong>Durée :</strong> {{ $leave->start_date && $leave->end_date ? $leave->start_date->diffInDays($leave->end_date) + 1 . ' jours' : '—' }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('leaves.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
            @if(Auth::user()->isAdmin() && $leave->status === 'En attente')
                <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline-block ms-2">
                    @csrf
                    <button type="submit" class="btn btn-success">Approuver</button>
                </form>
                <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline-block ms-2">
                    @csrf
                    <button type="submit" class="btn btn-warning">Refuser</button>
                </form>
            @endif
            <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Supprimer cette demande de congé ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
