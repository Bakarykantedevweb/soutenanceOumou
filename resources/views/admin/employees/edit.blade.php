@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Modifier un employé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employés</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $employee->first_name) }}" required>
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $employee->last_name) }}" required>
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" id="matricule" name="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $employee->matricule) }}" readonly required>
                    @error('matricule')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance', optional($employee->date_naissance)->format('Y-m-d')) }}" required>
                    @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="department" class="form-label">Département</label>
                    <select id="department" name="department" class="form-select @error('department') is-invalid @enderror">
                        <option value="">Sélectionner</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}" {{ old('department', $employee->department) == $department ? 'selected' : '' }}>{{ $department }}</option>
                        @endforeach
                    </select>
                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="position" class="form-label">Poste</label>
                    <select id="position" name="position" class="form-select @error('position') is-invalid @enderror">
                        <option value="">Sélectionner</option>
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ old('position', $employee->position) == $position ? 'selected' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="hired_at" class="form-label">Date d'embauche</label>
                    <input type="date" id="hired_at" name="hired_at" class="form-control @error('hired_at') is-invalid @enderror" value="{{ old('hired_at', $employee->hired_at?->format('Y-m-d')) }}" required>
                    @error('hired_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
