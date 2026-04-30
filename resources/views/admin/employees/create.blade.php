@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Ajouter un employé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employés</a></li>
                <li class="breadcrumb-item active">Nouvel employé</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <h4 class="mb-4 text-primary"><i class="fas fa-user-tie"></i> Informations Personnelles</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="matricule" class="form-label">Matricule (Auto)</label>
                    <input type="text" id="matricule" name="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $matricule) }}" readonly>
                    @error('matricule')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}" required>
                    @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="hired_at" class="form-label">Date d'embauche</label>
                    <input type="date" id="hired_at" name="hired_at" class="form-control @error('hired_at') is-invalid @enderror" value="{{ old('hired_at', date('Y-m-d')) }}" required>
                    @error('hired_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="department" class="form-label">Département</label>
                    <select id="department" name="department" class="form-select @error('department') is-invalid @enderror">
                        <option value="">Sélectionner</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}" {{ old('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                        @endforeach
                    </select>
                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">Poste</label>
                    <select id="position" name="position" class="form-select @error('position') is-invalid @enderror">
                        <option value="">Sélectionner</option>
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ old('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">
            <h4 class="mb-4 text-success"><i class="fas fa-file-contract"></i> Détails du Contrat</h4>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="num_contrat" class="form-label">Numéro de Contrat (Auto)</label>
                    <input type="text" id="num_contrat" name="num_contrat" class="form-control" value="{{ $num_contrat }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="type_contrat" class="form-label">Type de contrat</label>
                    <select id="type_contrat" name="type_contrat" class="form-select @error('type_contrat') is-invalid @enderror" required>
                        <option value="">Sélectionner</option>
                        @foreach($contract_types as $type)
                            <option value="{{ $type }}" {{ old('type_contrat') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="salaire_base" class="form-label">Salaire de base (FCFA)</label>
                    <input type="number" id="salaire_base" name="salaire_base" class="form-control @error('salaire_base') is-invalid @enderror" value="{{ old('salaire_base') }}" required>
                    @error('salaire_base')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date_debut" class="form-label">Date de début du contrat</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', date('Y-m-d')) }}" required>
                    @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_fin" class="form-label">Date de fin (Optionnel pour CDI)</label>
                    <input type="date" id="date_fin" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin') }}">
                    @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="situation_matrimoniale" class="form-label">Situation matrimoniale</label>
                    <select id="situation_matrimoniale" name="situation_matrimoniale" class="form-select @error('situation_matrimoniale') is-invalid @enderror" required>
                        <option value="">Sélectionner</option>
                        @foreach($marital_statuses as $status)
                            <option value="{{ $status }}" {{ old('situation_matrimoniale') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('situation_matrimoniale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="diplome" class="form-label">Dernier Diplôme</label>
                    <input type="text" id="diplome" name="diplome" class="form-control @error('diplome') is-invalid @enderror" value="{{ old('diplome') }}">
                    @error('diplome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-save"></i> Créer Employé & Générer Contrat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
