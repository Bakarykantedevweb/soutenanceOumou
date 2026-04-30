@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Performance</h3>
    <a href="{{ route('performances.create') }}" class="btn btn-primary">Nouvelle performance</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employé</th>
                    <th>Objectif</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($performances as $perf)
                <tr>
                    <td>{{ $perf->employe }}</td>
                    <td>{{ $perf->objectif }}</td>
                    <td>{{ $perf->note }}</td>
                    <td>{{ $perf->commentaire }}</td>
                    <td>
                        <a href="{{ route('performances.show', $perf) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('performances.edit', $perf) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('performances.destroy', $perf) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">Aucune performance</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
