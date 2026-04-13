@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Pointage des employés</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Pointage</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Enregistrer un pointage</h5>
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employé</label>
                        <select id="employee_id" name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
                            <option value="">Sélectionner un employé</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }} - {{ $employee->position ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                        @error('employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de pointage</label>
                        <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Sélectionner</option>
                            <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Arrivée</option>
                            <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Départ</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note (optionnel)</label>
                        <input type="text" id="note" name="note" class="form-control @error('note') is-invalid @enderror" value="{{ old('note') }}">
                        @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Derniers pointages</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Employé</th>
                                <th>Type</th>
                                <th>Date / heure</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->employee?->full_name ?? '—' }}</td>
                                    <td>{{ $attendance->type === 'in' ? 'Arrivée' : 'Départ' }}</td>
                                    <td>{{ $attendance->recorded_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $attendance->note ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">Aucun pointage enregistré.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
