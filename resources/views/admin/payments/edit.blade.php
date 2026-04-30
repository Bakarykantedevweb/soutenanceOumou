@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Modifier le paiement</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Paiements</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="employee_id" class="form-label">Employé</label>
                    <select id="employee_id" name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
                        <option value="">Aucun</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id', $payment->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="libelle" class="form-label">Libellé</label>
                    <input type="text" id="libelle" name="libelle" class="form-control @error('libelle') is-invalid @enderror" value="{{ old('libelle', $payment->libelle) }}" required>
                    @error('libelle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="montant" class="form-label">Montant</label>
                    <input type="number" step="0.01" id="montant" name="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $payment->montant) }}" required>
                    @error('montant')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_paiement" class="form-label">Date du paiement</label>
                    <input type="date" id="date_paiement" name="date_paiement" class="form-control @error('date_paiement') is-invalid @enderror" value="{{ old('date_paiement', $payment->date_paiement?->format('Y-m-d')) }}" required>
                    @error('date_paiement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="En attente" {{ old('status', $payment->status) == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Payé" {{ old('status', $payment->status) == 'Payé' ? 'selected' : '' }}>Payé</option>
                        <option value="Annulé" {{ old('status', $payment->status) == 'Annulé' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $payment->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
