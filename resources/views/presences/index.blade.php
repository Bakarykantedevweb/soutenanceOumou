@extends('layouts.admin')

@section('content')

<h1>Présences</h1>

<a href="{{ route('presences.create') }}" class="btn btn-primary">
    Ajouter
</a>

<table class="table">

<tr>
    <th>Employé</th>
    <th>Date</th>
    <th>Statut</th>
    <th>Action</th>
</tr>

@foreach($presences as $presence)
<tr>
    <td>{{ $presence->employe->nom }} {{ $presence->employe->prenom }}</td>
    <td>{{ $presence->date }}</td>
    <td>{{ $presence->statut }}</td>

    <td>
        <form action="{{ route('presences.destroy', $presence->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Supprimer</button>
        </form>
    </td>
</tr>
@endforeach

</table>
@endsection