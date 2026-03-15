@extends('layouts.admin')

@section('content')

<h1>Ajouter un service</h1>

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nom du service</label>
        <input type="text" name="nom" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        Enregistrer
    </button>

</form>

@endsection