@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Modifier une demande de congé</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Congés</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('leaves.update', $leave) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="employee_id" class="form-label">Employé</label>
                    <select id="employee_id" name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
                        <option value="">Sélectionner un employé</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id', $leave->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }} ({{ $employee->email }})</option>
                        @endforeach
                    </select>
                    @error('employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type de congé</label>
                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Sélectionner un type</option>
                        <option value="Congés annuels" {{ old('type', $leave->type) == 'Congés annuels' ? 'selected' : '' }}>Congés annuels</option>
                        <option value="Congés maladie" {{ old('type', $leave->type) == 'Congés maladie' ? 'selected' : '' }}>Congés maladie</option>
                        <option value="Congés maternité" {{ old('type', $leave->type) == 'Congés maternité' ? 'selected' : '' }}>Congés maternité</option>
                        <option value="Congés exceptionnels" {{ old('type', $leave->type) == 'Congés exceptionnels' ? 'selected' : '' }}>Congés exceptionnels</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $leave->start_date?->format('Y-m-d')) }}" required>
                    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $leave->end_date?->format('Y-m-d')) }}" required>
                    @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">Sélectionner</option>
                        <option value="En attente" {{ old('status', $leave->status) == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Approuvé" {{ old('status', $leave->status) == 'Approuvé' ? 'selected' : '' }}>Approuvé</option>
                        <option value="Refusé" {{ old('status', $leave->status) == 'Refusé' ? 'selected' : '' }}>Refusé</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label">Motif</label>
                <textarea id="reason" name="reason" rows="4" class="form-control @error('reason') is-invalid @enderror">{{ old('reason', $leave->reason) }}</textarea>
                @error('reason')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
