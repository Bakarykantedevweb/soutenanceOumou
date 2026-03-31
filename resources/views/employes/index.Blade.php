@extends('layouts.admin')

@section('content')

<h1>Liste des employés</h1>

<a href="{{ route('employes.create') }}" class="btn btn-primary mb-3">
    Ajouter un employé
</a>

<form method="GET" action="{{ route('employes.index') }}" class="mb-3">

    <input 
        type="text" 
        name="search" 
        value="{{ $search }}" 
        placeholder="Rechercher un employé..."
        class="form-control"
    >

    <button class="btn btn-primary mt-2">Rechercher</button>

</form>

<table class="table table-bordered">

    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Service</th>
        <th>Poste</th>
        <th>Actions</th>
    </tr>

    @foreach($employes as $employe)
    <tr>
        <td>{{ $employe->nom }}</td>
        <td>{{ $employe->prenom }}</td>
        <td>{{ $employe->email }}</td>
        <td>{{ $employe->telephone ?? '-' }}</td>
        <td>{{ $employe->service->nom }}</td>
        <td>{{ $employe->poste->nom }}</td>
        
        <td>

            {{-- Modifier --}}
            <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning">
                Modifier
            </a>

            {{-- Supprimer --}}
            <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" style="display:inline">

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
{{ $employes->appends(['search' => $search])->links() }}
@endsection