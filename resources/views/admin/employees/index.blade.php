@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Employés</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Employés</li>
            </ul>
        </div>
        <div class="col-auto float-end ms-auto">
            <a href="{{ route('employees.create') }}" class="btn btn-primary"><i class="ti ti-user-plus"></i> Ajouter un employé</a>
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
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Matricule</th>
                        <th>Département</th>
                        <th>Poste</th>
                        <th>Date de naissance</th>
                        <th>Date d'embauche</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->full_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->matricule }}</td>
                            <td>{{ $employee->department ?? '—' }}</td>
                            <td>{{ $employee->position ?? '—' }}</td>
                            <td>{{ optional($employee->date_naissance)->format('d/m/Y') ?? '—' }}</td>
                            <td>{{ optional($employee->hired_at)->format('d/m/Y') ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-outline-secondary me-1">Détails</a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary me-1">Modifier</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer cet employé ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucun employé enregistré pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $employees->withQueryString()->links() }}
    </div>
</div>
@endsection
