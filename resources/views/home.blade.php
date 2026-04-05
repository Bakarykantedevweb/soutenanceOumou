@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Dashboard RH</h2>

{{--  STATISTIQUES --}}
<div class="row">

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Employés</small>
            <h4>{{ $employes }}</h4>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Services</small>
            <h4>{{ $services }}</h4>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Postes</small>
            <h4>{{ $postes }}</h4>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Absences</small>
            <h4>{{ $absences }}</h4>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Congés</small>
            <h4>{{ $conges }}</h4>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Présences</small>
            <h4>{{ $presences }}</h4>
        </div>
    </div>

</div>

{{--  TABLEAU EMPLOYÉS --}}
<div class="card shadow-sm p-4 mt-4">

    <h5>Derniers employés</h5>

    <table class="table table-hover mt-3">

        <thead>
            <tr>
                <th>Nom</th>
                <th>Service</th>
                <th>Poste</th>
            </tr>
        </thead>

        <tbody>

        @foreach($latestEmployes as $emp)
        <tr>
            <td>{{ $emp->nom }} {{ $emp->prenom }}</td>
            <td>{{ $emp->service->nom ?? '-' }}</td>
            <td>{{ $emp->poste->nom ?? '-' }}</td>
        </tr>
        @endforeach

        </tbody>

    </table>

</div>

{{--  STATS SIMPLES --}}
<div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Absences du mois</small>
            <h4>{{ $absencesMois }}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <small class="text-muted">Présences du jour</small>
            <h4>{{ $presencesJour }}</h4>
        </div>
    </div>

</div>

{{--  EMPLOYÉS PAR SERVICE --}}
<div class="card shadow-sm p-4 mt-4">

    <h5>Employés par service</h5>

    <table class="table mt-3">

        <tr>
            <th>Service</th>
            <th>Nombre</th>
        </tr>

        @foreach($employesParService as $item)
        <tr>
            <td>{{ $item->nom }}</td>
            <td>{{ $item->total }}</td>
        </tr>
        @endforeach

    </table>

</div>

@endsection