@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Détail de l'évaluation</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('performances.index') }}">Performance</a></li>
                <li class="breadcrumb-item active">Détail</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-3">{{ $performance->employe }}</h4>
        <p><strong>Objectif :</strong> {{ $performance->objectif }}</p>
        <p><strong>Note :</strong> {{ $performance->note ?? 'Non renseignée' }}</p>
        <div class="mb-3">
            <h6>Commentaire</h6>
            <p>{{ $performance->commentaire ?? 'Aucun commentaire.' }}</p>
        </div>
        <a href="{{ route('performances.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@endsection
