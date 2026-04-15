@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Ajouter un contrat</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contrats</a></li>
                <li class="breadcrumb-item active">Nouveau contrat</li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('contracts.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="agent_id" class="form-label">Agent</label>
                    <select id="agent_id" name="agent_id" class="form-select @error('agent_id') is-invalid @enderror" required>
                        <option value="">Sélectionner un agent</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('agent_id') == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }} ({{ $employee->email }})</option>
                        @endforeach
                    </select>
                    @error('agent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="num_contrat" class="form-label">Numéro de contrat</label>
                    <input type="text" id="num_contrat" name="num_contrat" class="form-control @error('num_contrat') is-invalid @enderror" readonly value="{{ old('num_contrat') }}" required>
                    @error('num_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type_contrat" class="form-label">Type de contrat</label>
                    <select type="text" id="type_contrat" name="type_contrat" class="form-control @error('type_contrat') is-invalid @enderror" value="{{ old('type_contrat') }}" required>>
                        <option value=""> Sélectionner un contrat </option>
                        <option value="CDD">CDD</option>
                        <option value="CDI">CDI</option>
                    </select> 
                    @error('type_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut') }}" required>
                    @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div id="date_fin_field" class="col-md-3 mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin') }}">
                    @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="salaire_base" class="form-label">Salaire de base</label>
                    <input type="number" step="0.01" id="salaire_base" name="salaire_base" class="form-control @error('salaire_base') is-invalid @enderror" value="{{ old('salaire_base') }}" required>
                    @error('salaire_base')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="situation_matrimoniale" class="form-label">Situation matrimoniale</label>
                    <select type="text" id="situation_matrimoniale" name="situation_matrimoniale" class="form-control @error('situation_matrimoniale') is-invalid @enderror" value="{{ old('situation_matrimoniale') }}" required>>
                        <option value=""> Sélectionner </option>
                        <option value="celibataire">Célibataire</option>
                        <option value="marie">Marié</option>
                    </select>  
                    @error('situation_matrimoniale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="diplome" class="form-label">Diplôme</label>
                    <select id="diplome" name="diplome" class="form-select @error('diplome') is-invalid @enderror" required>
                        <option value="">Sélectionner un diplôme</option>
                        @foreach($diplomes as $option)
                            <option value="{{ $option }}" {{ old('diplome') === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('diplome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer le contrat</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('type_contrat').addEventListener('change', function () {
    let field = document.getElementById('date_fin_field');

    if (this.value === 'CDI') {
        field.style.display = 'none';
    } else {
        field.style.display = 'block';
    }
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let diplome = document.getElementById('diplome');
    let salaire = document.getElementById('salaire_base');

    if (diplome && salaire) {

        diplome.addEventListener('change', function () {

            switch(this.value) {
                case 'Baccalauréat':
                    salaire.value = 125000;
                    break;
                case 'BTS':
                case 'DUT':
                    salaire.value = 200000;
                    break;
                case 'Licence Professionnelle':
                    salaire.value = 250000;
                    break;
                case 'Licence':
                    salaire.value = 300000;
                    break;
                case 'Master':
                    salaire.value = 400000;
                    break;
                case 'Ingénieur':
                    salaire.value = 450000;
                    break;
            case 'MBA':
                salaire.value = 500000;
                break;
            case 'Doctorat':
                    salaire.value = 600000;
                    break;
                default:
                    salaire.value = '';
            }

        });

    }

});
</script>

@endsection
