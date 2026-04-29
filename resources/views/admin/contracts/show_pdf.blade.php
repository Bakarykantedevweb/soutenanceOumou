@extends('layouts.admin')

@section('content')
<div class="container my-5 no-print">
    <div class="row mb-4">
        <div class="col">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Imprimer / Enregistrer en PDF
            </button>
            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary">Retour au profil</a>
        </div>
    </div>
</div>

<div class="contract-box p-5 bg-white shadow-sm mx-auto" style="max-width: 800px; color: #333; font-family: 'Times New Roman', serif;">
    <div class="text-center mb-5">
        <h1 class="text-uppercase" style="text-decoration: underline;">Contrat de Travail</h1>
        <p class="lead">N° de contrat : <strong>{{ $contract->num_contrat }}</strong></p>
    </div>

    <div class="mb-4">
        <p>Entre les soussignés :</p>
        <p><strong>L'Entreprise SoutenanceOumou</strong>, sise à Bamako, représentée par la Direction des Ressources Humaines, ci-après désignée "L'Employeur",</p>
        <p>Et</p>
        <p><strong>M/Mme {{ $employee->full_name }}</strong>, né(e) le {{ $employee->date_naissance->format('d/m/Y') }}, 
           titulaire du diplôme : {{ $contract->diplome ?? 'N/A' }},
           demeurant à {{ $employee->phone ?? 'Contact : ' . $employee->email }},
           ci-après désigné(e) "L'Employé(e)".</p>
    </div>

    <div class="mb-4">
        <h4>Article 1 : Objet du contrat</h4>
        <p>L'Employé(e) est engagé(e) sous le régime d'un <strong>{{ $contract->type_contrat }}</strong> en qualité de <strong>{{ $employee->position }}</strong> au sein du département <strong>{{ $employee->department }}</strong>.</p>
    </div>

    <div class="mb-4">
        <h4>Article 2 : Durée et Prise d'effet</h4>
        <p>Le présent contrat prend effet à compter du <strong>{{ $contract->date_debut->format('d/m/Y') }}</strong>.</p>
        @if($contract->date_fin)
            <p>Il prendra fin le {{ $contract->date_fin->format('d/m/Y') }}.</p>
        @else
            <p>Il est conclu pour une durée indéterminée.</p>
        @endif
    </div>

    <div class="mb-4">
        <h4>Article 3 : Rémunération</h4>
        <p>En contrepartie de ses services, l'Employé(e) percevra un salaire de base mensuel de <strong>{{ number_format($contract->salaire_base, 0, ',', ' ') }} FCFA</strong>.</p>
    </div>

    <div class="mt-5 pt-5">
        <div class="row">
            <div class="col-6 text-center">
                <p><strong>L'Employé(e)</strong></p>
                <div style="height: 100px;"></div>
                <p>(Signature précédée de "Lu et approuvé")</p>
            </div>
            <div class="col-6 text-center">
                <p><strong>L'Employeur</strong></p>
                <div style="height: 100px;"></div>
                <p>(Cachet et Signature)</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print, .main-header, .sidebar, .footer, .breadcrumb {
        display: none !important;
    }
    .page-wrapper {
        margin: 0 !important;
        padding: 0 !important;
    }
    .contract-box {
        box-shadow: none !important;
        max-width: 100% !important;
        padding: 0 !important;
    }
}
</style>
@endsection
