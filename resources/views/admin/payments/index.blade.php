@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Paiements</h3>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">Nouveau paiement</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Employé</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->libelle }}</td>
                        <td>{{ $payment->employee?->full_name ?? 'N/A' }}</td>
                        <td>{{ number_format($payment->montant, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $payment->date_paiement ? $payment->date_paiement->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $payment->status == 'Payé' ? 'success' : ($payment->status == 'Annulé' ? 'danger' : 'warning') }} text-white">{{ $payment->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer ce paiement ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Aucun paiement enregistré.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
