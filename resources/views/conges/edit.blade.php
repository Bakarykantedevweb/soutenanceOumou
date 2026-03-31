@extends('layouts.admin')

@section('content')

<h1>Modifier un congé</h1>

<form action="{{ route('conges.update', $conge->id) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="employe_id" class="form-control mb-2">
        @foreach($employes as $employe)
            <option value="{{ $employe->id }}" {{ $conge->employe_id == $employe->id ? 'selected' : '' }}>
                {{ $employe->nom }} {{ $employe->prenom }}
            </option>
        @endforeach
    </select>

    <input type="text" name="type" value="{{ $conge->type }}" class="form-control mb-2">

    <input type="date" name="date_debut" value="{{ $conge->date_debut }}" class="form-control mb-2">
    <input type="date" name="date_fin" value="{{ $conge->date_fin }}" class="form-control mb-2">

    <textarea name="motif" class="form-control mb-2">{{ $conge->motif }}</textarea>

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection