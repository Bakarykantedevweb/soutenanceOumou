@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Modifier l'évaluation</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('performances.index') }}">Performance</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('performances.update', $performance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="employe" class="form-label">Employé</label>
                <input type="text" id="employe" name="employe" class="form-control @error('employe') is-invalid @enderror" value="{{ old('employe', $performance->employe) }}" required>
                @error('employe')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="objectif" class="form-label">Objectif</label>
                <input type="text" id="objectif" name="objectif" class="form-control @error('objectif') is-invalid @enderror" value="{{ old('objectif', $performance->objectif) }}" required>
                @error('objectif')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" id="note" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note', $performance->note) }}" min="0" max="100">
                    @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <input type="text" id="commentaire" name="commentaire" class="form-control @error('commentaire') is-invalid @enderror" value="{{ old('commentaire', $performance->commentaire) }}">
                    @error('commentaire')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('performances.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
