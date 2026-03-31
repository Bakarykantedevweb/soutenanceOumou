@extends('layouts.admin')

@section('content')

<h1>Modifier un poste</h1>

<form action="{{ route('postes.update', $poste->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom du poste</label>
        <input type="text" name="nom" class="form-control" value="{{ $poste->nom }}">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $poste->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Modifier
    </button>

</form>

@endsection