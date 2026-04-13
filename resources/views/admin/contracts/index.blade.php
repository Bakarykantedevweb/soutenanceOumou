@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Contrats</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Contrats</li>
            </ul>
        </div>
        <div class="col-auto float-end ms-auto">
            <a href="{{ route('contracts.create') }}" class="btn btn-primary"><i class="ti ti-file-plus"></i> Nouvel contrat</a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Numéro contrat</th>
                        <th>Type</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Salaire</th>
                        <th>Situation</th>
                        <th>Diplôme</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contracts as $contract)
                        <tr>
                            <td>{{ $contract->agent_id }}</td>
                            <td>{{ $contract->employee?->full_name ?? '—' }}</td>
                            <td>{{ $contract->num_contrat }}</td>
                            <td>{{ $contract->type_contrat }}</td>
                            <td>{{ optional($contract->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ optional($contract->date_fin)->format('d/m/Y') ?? '—' }}</td>
                            <td>{{ number_format($contract->salaire_base, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $contract->situation_matrimoniale }}</td>
                            <td>{{ $contract->diplome }}</td>
                            <td class="text-end">
                                <a href="{{ route('contracts.show', $contract) }}" class="btn btn-sm btn-outline-secondary me-1">Détails</a>
                                <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-sm btn-outline-primary me-1">Modifier</a>
                                <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer ce contrat ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Aucun contrat enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $contracts->withQueryString()->links() }}
    </div>
</div>
@endsection
