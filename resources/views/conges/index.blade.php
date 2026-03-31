@extends('layouts.admin')

@section('content')

<h1>Liste des congés</h1>

<a href="{{ route('conges.create') }}" class="btn btn-primary mb-3">
    Ajouter un congé
</a>

<table class="table table-bordered">

<tr>
    <th>Employé</th>
    <th>Type</th>
    <th>Date début</th>
    <th>Date fin</th>
    <th>Motif</th>
    <th>statut</th>
    <th>Actions</th>
</tr>

@foreach($conges as $conge)
<tr>
    <td>{{ $conge->employe->nom }} {{ $conge->employe->prenom }}</td>
    <td>{{ $conge->type }}</td>
    <td>{{ $conge->date_debut }}</td>
    <td>{{ $conge->date_fin }}</td>
    <td>{{ $conge->motif ?? '-' }}</td>
    <td>{{ $conge->statut }}</td>
    <td>

    {{-- Modifier --}}
    <a href="{{ route('conges.edit', $conge->id) }}" class="btn btn-warning">
        Modifier
    </a>

    {{-- Supprimer --}}
    <form action="{{ route('conges.destroy', $conge->id) }}" method="POST" style="display:inline">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger">
            Supprimer
        </button>

    </form>

</td>
</tr>
@endforeach

</table>

{{ $conges->links() }}

@endsection