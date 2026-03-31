@extends('layouts.admin')

@section('content')

<h1>Ajouter une absence</h1>

<form action="{{ route('absences.store') }}" method="POST">
    @csrf

    {{-- Choix employé --}}
    <select name="employe_id" class="form-control mb-2">
        @foreach($employes as $employe)
            <option value="{{ $employe->id }}">
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>

    {{-- Date --}}
    <input type="date" name="date_absence" class="form-control mb-2">

    {{-- Motif --}}
    <textarea name="motif" class="form-control mb-2"></textarea>

    <button class="btn btn-success">Enregistrer</button>

</form>

@endsection