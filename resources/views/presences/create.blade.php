@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Ajouter une présence</h1>

<form action="{{ route('presences.store') }}" method="POST">
    @csrf

    <div class="card p-4 shadow">

        {{-- Employé --}}
        <div class="mb-3">
            <label class="form-label">Employé</label>
            <select name="employe_id" class="form-control">
                @foreach($employes as $employe)
                    <option value="{{ $employe->id }}">
                        {{ $employe->nom }} {{ $employe->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control">
        </div>

        {{-- Bouton --}}
        <div class="text-end">
            <button class="btn btn-success">
                Enregistrer
            </button>
        </div>

    </div>

</form>

@endsection