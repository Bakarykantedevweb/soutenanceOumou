@extends('layouts.admin')

@section('content')

<h1>Liste des services</h1>

<a href="{{ route('services.create') }}" class="btn btn-primary mb-3">
    Ajouter un service
</a>

{{-- Tableau qui affiche les services --}}
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

        {{-- Boucle pour afficher tous les services --}}
        @foreach($services as $service)

        <tr>

            <td>{{ $service->id }}</td>

            <td>{{ $service->nom }}</td>

            <td>{{ $service->description }}</td>

            <td>

                {{-- Bouton modifier --}}
                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">
                    Modifier
                </a>
                {{-- Formulaire pour supprimer un service --}}
                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">

                    {{-- Protection CSRF obligatoire --}}
                    @csrf

                    {{-- Laravel utilise DELETE pour la suppression --}}
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