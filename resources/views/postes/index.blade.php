@extends('layouts.admin')

@section('content')

<h1>Liste des postes</h1>

<a href="{{ route('postes.create') }}" class="btn btn-primary mb-3">
    Ajouter un poste
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        {{-- boucle pour afficher tous les postes --}}
        @foreach($postes as $poste)

        <tr>

            <td>{{ $poste->id }}</td>

            <td>{{ $poste->nom }}</td>

            <td>{{ $poste->description }}</td>

            <td>

                {{-- bouton modifier --}}
                <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-warning">
                    Modifier
                </a>

                {{-- bouton supprimer --}}
                <form action="{{ route('postes.destroy', $poste->id) }}" method="POST" style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Supprimer
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection