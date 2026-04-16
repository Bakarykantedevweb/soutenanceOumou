@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Départements Orange</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Départements</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach($departments as $department)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $department }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Retour au tableau de bord</a>
        </div>
    </div>
</div>
@endsection
