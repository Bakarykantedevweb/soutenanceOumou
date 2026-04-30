@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Formations</h3>
    <a href="{{ route('trainings.create') }}" class="btn btn-primary">Nouvelle formation</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $training)
                <tr>
                    <td>{{ $training->titre }}</td>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->date_debut }}</td>
                    <td>{{ $training->date_fin }}</td>
                    <td>
                        <a href="{{ route('trainings.show', $training) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('trainings.edit', $training) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">Aucune formation</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
