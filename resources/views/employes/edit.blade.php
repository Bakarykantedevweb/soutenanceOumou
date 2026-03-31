@extends('layouts.admin')

@section('content')

<h1>Modifier un employé</h1>

<form action="{{ route('employes.update', $employe->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nom" value="{{ $employe->nom }}" class="form-control mb-2">

    <input type="text" name="prenom" value="{{ $employe->prenom }}" class="form-control mb-2">

    <input type="email" name="email" value="{{ $employe->email }}" class="form-control mb-2">

    <input type="text" name="telephone" value="{{ $employe->telephone }}" class="form-control mb-2">

    {{-- Service --}}
    <select name="service_id" class="form-control mb-2">
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ $employe->service_id == $service->id ? 'selected' : '' }}>
                {{ $service->nom }}
            </option>
        @endforeach
    </select>

    {{-- Poste --}}
    <select name="poste_id" class="form-control mb-2">
        @foreach($postes as $poste)
            <option value="{{ $poste->id }}" {{ $employe->poste_id == $poste->id ? 'selected' : '' }}>
                {{ $poste->nom }}
            </option>
        @endforeach
    </select>

    <input type="date" name="date_embauche" value="{{ $employe->date_embauche }}" class="form-control mb-2">

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection