@extends('layouts.admin')

@section('content')

<h1>Ajouter un congé</h1>

<form action="{{ route('conges.store') }}" method="POST">
    @csrf

    {{-- Employé --}}
    <select name="employe_id" class="form-control mb-2">
        @foreach($employes as $employe)
            <option value="{{ $employe->id }}">
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>

    <input type="text" name="type" placeholder="Type de congé" class="form-control mb-2">

    <input type="date" name="date_debut" class="form-control mb-2">
    <input type="date" name="date_fin" class="form-control mb-2">

    <textarea name="motif" class="form-control mb-2" placeholder="Motif"></textarea>

    <button class="btn btn-success">Enregistrer</button>

</form>

@endsection