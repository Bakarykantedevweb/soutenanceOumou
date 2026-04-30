@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détail de la formation</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('trainings.index') }}">Formations</a></li>
                <li class="breadcrumb-item active">Détail</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-3">{{ $training->titre }}</h4>
        <p><strong>Date de début :</strong> {{ $training->date_debut ? $training->date_debut->format('d/m/Y') : 'Non définie' }}</p>
        <p><strong>Date de fin :</strong> {{ $training->date_fin ? $training->date_fin->format('d/m/Y') : 'Non définie' }}</p>
        <div class="mb-3">
            <h6>Description</h6>
            <p>{{ $training->description ?? 'Aucune description fournie.' }}</p>
        </div>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection
