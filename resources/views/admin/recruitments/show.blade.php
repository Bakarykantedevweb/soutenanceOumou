@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détail de l'offre</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('recruitments.index') }}">Recrutement</a></li>
                <li class="breadcrumb-item active">Détail</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-3">{{ $recruitment->poste }}</h4>
        <p><strong>Date limite :</strong> {{ $recruitment->date_limite ? $recruitment->date_limite->format('d/m/Y') : 'Non défini' }}</p>
        <div class="mb-3">
            <h6>Description</h6>
            <p>{{ $recruitment->description ?? 'Aucune description fournie.' }}</p>
        </div>
        <a href="{{ route('recruitments.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection
