@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Nouvelle offre de recrutement</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitments.index') }}">Recrutement</a></li>
                <li class="breadcrumb-item active">Nouvelle offre</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('recruitments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="poste" class="form-label">Poste</label>
                <input type="text" id="poste" name="poste" class="form-control @error('poste') is-invalid @enderror" value="{{ old('poste') }}" required>
                @error('poste')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="date_limite" class="form-label">Date limite</label>
                <input type="date" id="date_limite" name="date_limite" class="form-control @error('date_limite') is-invalid @enderror" value="{{ old('date_limite') }}">
                @error('date_limite')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('recruitments.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
