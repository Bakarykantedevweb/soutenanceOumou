@extends('layouts.admin')

@section('content')

<h1>Ajouter un employé</h1>

<form action="{{ route('employes.store') }}" method="POST">
    @csrf

    <input type="text" name="nom" placeholder="Nom" class="form-control mb-2">

    <input type="text" name="prenom" placeholder="Prénom" class="form-control mb-2">

    <input type="email" name="email" placeholder="Email" class="form-control mb-2">

    <input type="text" name="telephone" placeholder="Téléphone" class="form-control mb-2">

    {{-- Service --}}
    <select name="service_id" class="form-control mb-2">
        @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->nom }}</option>
        @endforeach
    </select>

    {{-- Poste --}}
    <select name="poste_id" class="form-control mb-2">
        @foreach($postes as $poste)
            <option value="{{ $poste->id }}">{{ $poste->nom }}</option>
        @endforeach
    </select>

    <input type="date" name="date_embauche" class="form-control mb-2">

    <button class="btn btn-success">Enregistrer</button>

</form>

@endsection