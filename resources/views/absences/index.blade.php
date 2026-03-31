@extends('layouts.admin')

@section('content')

<h1>Liste des absences</h1>

<a href="{{ route('absences.create') }}" class="btn btn-primary mb-3">
    Ajouter une absence
</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Motif</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @foreach($absences as $absence)

        <tr>
            <td>{{ $absence->employe->nom }} {{ $absence->employe->prenom }}</td>

            <td>{{ $absence->date_absence }}</td>

            <td>{{ $absence->motif ?? '-' }}</td>

            <td>
                <form action="{{ route('absences.destroy', $absence->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection