@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Modifier un contrat</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contrats</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('contracts.update', $contract) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="agent_id" class="form-label">Agent</label>
                    <select id="agent_id" name="agent_id" class="form-select @error('agent_id') is-invalid @enderror" required>
                        <option value="">Sélectionner un agent</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('agent_id', $contract->agent_id) == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }} ({{ $employee->email }})</option>
                        @endforeach
                    </select>
                    @error('agent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="num_contrat" class="form-label">Numéro de contrat</label>
                    <input type="text" id="num_contrat" name="num_contrat" class="form-control @error('num_contrat') is-invalid @enderror" value="{{ old('num_contrat', $contract->num_contrat) }}" required>
                    @error('num_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type_contrat" class="form-label">Type de contrat</label>
                    <input type="text" id="type_contrat" name="type_contrat" class="form-control @error('type_contrat') is-invalid @enderror" value="{{ old('type_contrat', $contract->type_contrat) }}" required>
                    @error('type_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', $contract->date_debut?->format('Y-m-d')) }}" required>
                    @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin', $contract->date_fin?->format('Y-m-d')) }}">
                    @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="salaire_base" class="form-label">Salaire de base</label>
                    <input type="number" step="0.01" id="salaire_base" name="salaire_base" class="form-control @error('salaire_base') is-invalid @enderror" value="{{ old('salaire_base', $contract->salaire_base) }}" required>
                    @error('salaire_base')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="situation_matrimoniale" class="form-label">Situation matrimoniale</label>
                    <input type="text" id="situation_matrimoniale" name="situation_matrimoniale" class="form-control @error('situation_matrimoniale') is-invalid @enderror" value="{{ old('situation_matrimoniale', $contract->situation_matrimoniale) }}" required>
                    @error('situation_matrimoniale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="diplome" class="form-label">Diplôme</label>
                    <select id="diplome" name="diplome" class="form-select @error('diplome') is-invalid @enderror" required>
                        <option value="">Sélectionner un diplôme</option>
                        @foreach($diplomes as $option)
                            <option value="{{ $option }}" {{ old('diplome', $contract->diplome) === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('diplome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour le contrat</button>
        </form>
    </div>
</div>
@endsection
