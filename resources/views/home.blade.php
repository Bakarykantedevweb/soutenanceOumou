@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Dashboard</h1>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5>Employés</h5>
                <h2>{{ $employes }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5>Services</h5>
                <h2>{{ $services }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5>Postes</h5>
                <h2>{{ $postes }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-danger shadow">
            <div class="card-body">
                <h5>Absences</h5>
                <h2>{{ $absences }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <h5>Congés</h5>
                <h2>{{ $conges }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-dark shadow">
            <div class="card-body">
                <h5>Présences</h5>
                <h2>{{ $presences }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection