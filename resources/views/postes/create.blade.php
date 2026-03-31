@extends('layouts.admin')

@section('content')

<h1>Ajouter un poste</h1>

<form action="{{ route('postes.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nom du poste</label>
        <input type="text" name="nom" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
    <label>Service</label>
    <select name="service_id" class="form-control">

        @foreach($services as $service)
            <option value="{{ $service->id }}">
                {{ $service->nom }}
            </option>
        @endforeach

    </select>
    </div>
    <button type="submit" class="btn btn-success">
        Enregistrer
    </button>

</form>

@endsection