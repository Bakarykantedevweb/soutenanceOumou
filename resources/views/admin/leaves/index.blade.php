@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Demandes de congé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Congés</li>
            </ul>
        </div>
        <div class="col-auto float-end ms-auto">
            <a href="{{ route('leaves.create') }}" class="btn btn-primary"><i class="ti ti-calendar-plus"></i> Nouvelle demande</a>
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
                        <th>Employé</th>
                        <th>Type</th>
                        <th>Période</th>
                        <th>Statut</th>
                        <th>Motif</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td>{{ $leave->employee?->full_name ?? '—' }}</td>
                            <td>{{ $leave->type }}</td>
                            <td>{{ optional($leave->start_date)->format('d/m/Y') }} – {{ optional($leave->end_date)->format('d/m/Y') }}</td>
                            <td>{{ $leave->status }}</td>
                            <td>{{ $leave->reason ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('leaves.show', $leave) }}" class="btn btn-sm btn-outline-secondary me-1">Détails</a>
                                <a href="{{ route('leaves.edit', $leave) }}" class="btn btn-sm btn-outline-primary me-1">Modifier</a>
                                @if(Auth::user()->isAdmin() && $leave->status === 'En attente')
                                    <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline-block me-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approuver</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline-block me-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Refuser</button>
                                    </form>
                                @endif
                                <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer cette demande de congé ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucune demande de congé enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $leaves->withQueryString()->links() }}
    </div>
</div>
@endsection
