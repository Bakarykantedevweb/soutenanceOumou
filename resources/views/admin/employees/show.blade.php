@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détails de l'employé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employés</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ul>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('employees.badge', $employee) }}" class="btn btn-success me-2" target="_blank">
                <i class="fas fa-id-card"></i> Générer Badge
            </a>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Modifier</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Informations personnelles</h5>
                <p><strong>Nom complet :</strong> {{ $employee->full_name }}</p>
                <p><strong>Matricule :</strong> {{ $employee->matricule }}</p>
                <p><strong>Email :</strong> {{ $employee->email }}</p>
                <p><strong>Téléphone :</strong> {{ $employee->phone ?? '—' }}</p>
                <p><strong>Département :</strong> {{ $employee->department ?? '—' }}</p>
                <p><strong>Poste :</strong> {{ $employee->position ?? '—' }}</p>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Informations RH</h5>
                <p><strong>Date de naissance :</strong> {{ optional($employee->date_naissance)->format('d/m/Y') ?? '—' }}</p>
                <p><strong>Date d'embauche :</strong> {{ optional($employee->hired_at)->format('d/m/Y') ?? '—' }}</p>
                <p><strong>Congés enregistrés :</strong> {{ $employee->leaves()->count() }}</p>
            </div>
        </div>

        <hr class="my-4">
        <h5 class="mb-3"><i class="fas fa-file-contract text-success"></i> Contrats associés</h5>
        @if($employee->contracts->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N° Contrat</th>
                            <th>Type</th>
                            <th>Début</th>
                            <th>Salaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->contracts as $contract)
                            <tr>
                                <td>{{ $contract->num_contrat }}</td>
                                <td><span class="badge bg-info">{{ $contract->type_contrat }}</span></td>
                                <td>{{ $contract->date_debut->format('d/m/Y') }}</td>
                                <td>{{ number_format($contract->salaire_base, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    <a href="{{ route('contracts.pdf', $contract->id) }}" class="btn btn-sm btn-success" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Voir / Imprimer PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Aucun contrat enregistré pour cet employé.</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Supprimer cet employé ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
