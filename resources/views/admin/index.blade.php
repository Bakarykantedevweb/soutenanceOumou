@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ auth()->user()->isAdmin() ? 'Tableau de bord Admin' : 'Mon Espace Employé' }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ul>
            </div>
            @if(!auth()->user()->isAdmin())
            <div class="col-auto ms-auto">
                <a href="{{ route('leaves.create') }}" class="btn btn-success">
                    <i class="ti ti-calendar-plus me-1"></i> Demander un congé
                </a>
            </div>
            @endif
        </div>
    </div>

    @if(auth()->user()->isAdmin())
        {{-- DASHBOARD ADMIN --}}
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar avatar-xl rounded-circle bg-primary text-white">
                            <i class="ti ti-user-shield fs-24"></i>
                        </span>
                        <div>
                            <h5 class="mb-1">Mode Administrateur</h5>
                            <p class="mb-0 text-muted">Bienvenue, {{ auth()->user()->getNameAttribute() }}. Vous avez le plein contrôle sur le système.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="mb-2 text-muted fw-bold text-uppercase fs-12">Résumé Global</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary-transparent text-primary">{{ $employeeCount }} Employés</span>
                            <span class="badge bg-warning-transparent text-warning">{{ $pendingLeaves }} En attente</span>
                            <span class="badge bg-success-transparent text-success">{{ $approvedLeaves }} Approuvés</span>
                            <span class="badge bg-info-transparent text-info">{{ $todayAttendances }} Présents aujourd'hui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Ici on pourrait mettre les graphiques plus tard --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Statistiques par Département</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="deptChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('deptChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Nombre d\'employés',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: '#3b82f6',
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        </script>

    @else
        {{-- DASHBOARD EMPLOYÉ --}}
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-4">
                            <div class="bg-white p-1 rounded-circle">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->getNameAttribute()) }}&background=random" class="rounded-circle" width="80">
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Bonjour, {{ auth()->user()->prenom }} !</h2>
                                <p class="mb-0 opacity-75">Matricule : {{ $employee->matricule ?? 'N/A' }} | Poste : {{ $employee->position ?? 'Agent' }}</p>
                                <div class="mt-3">
                                    @if($todayAttendance)
                                        <span class="badge bg-white text-primary px-3 py-2">
                                            <i class="ti ti-check me-1"></i> Pointé ce matin à {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('H:i') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="ti ti-clock me-1"></i> Vous n'avez pas encore pointé aujourd'hui
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                        <h6 class="text-muted text-uppercase fw-bold mb-3">Mes Congés</h6>
                        <div class="row g-0">
                            <div class="col-6 border-end">
                                <h3 class="fw-bold text-primary mb-0">{{ $myPendingLeaves }}</h3>
                                <p class="text-muted small mb-0">En attente</p>
                            </div>
                            <div class="col-6">
                                <h3 class="fw-bold text-success mb-0">{{ $myApprovedLeaves }}</h3>
                                <p class="text-muted small mb-0">Approuvés</p>
                            </div>
                        </div>
                        <a href="{{ route('leaves.index') }}" class="btn btn-outline-primary btn-sm mt-4">Voir mon historique</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0"><i class="ti ti-history me-2"></i>Mes Derniers Pointages</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Arrivée</th>
                                        <th>Départ</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($myAttendances as $att)
                                    <tr>
                                        <td>{{ $att->date->format('d/m/Y') }}</td>
                                        <td class="text-success fw-bold">{{ $att->check_in ?? '--:--' }}</td>
                                        <td class="text-danger fw-bold">{{ $att->check_out ?? '--:--' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $att->status == 'Present' ? 'success' : 'warning' }}">
                                                {{ $att->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center py-4">Aucun pointage trouvé.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
