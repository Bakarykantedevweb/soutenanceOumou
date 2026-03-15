@extends('layouts.admin')

@section('content')

<h1>Modifier un service</h1>

{{-- Formulaire de modification du service --}}
<form action="{{ route('services.update', $service->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        {{-- Nom du service --}}
        <label>Nom du service</label>

        <input type="text" name="nom" class="form-control"
        value="{{ $service->nom }}">

    </div>

    <div class="mb-3">

        {{-- Description du service --}}
        <label>Description</label>

        <textarea name="description" class="form-control">
{{ $service->description }}
</textarea>

    </div>

    <button type="submit" class="btn btn-success">
        Mettre à jour
    </button>

</form>

@endsection