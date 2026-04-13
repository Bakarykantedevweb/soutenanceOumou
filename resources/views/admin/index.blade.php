@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tableau de bord RH</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ul>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('employees.create') }}" class="btn btn-primary me-2"><i class="ti ti-user-plus me-1"></i> Nouvel employé</a>
                <a href="{{ route('leaves.create') }}" class="btn btn-success"><i class="ti ti-calendar-plus me-1"></i> Nouvelle demande</a>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="avatar avatar-xl rounded-circle bg-primary text-white">
                        <i class="ti ti-user fs-24"></i>
                    </span>
                    <div>
                        <h5 class="mb-1">Bienvenue, {{ auth()->user()->name }}</h5>
                        <p class="mb-0 text-muted">Gérez les employés et les congés d’Orange Mali depuis ce tableau de bord.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-center gap-2">
                    <p class="mb-1 text-muted">Résumé RH</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary">{{ $employeeCount ?? 0 }} Employés</span>
                        <span class="badge bg-secondary">{{ $leaveCount ?? 0 }} Congés</span>
                        <span class="badge bg-info text-dark">{{ $contractCount ?? 0 }} Contrats</span>
                        <span class="badge bg-warning text-dark">{{ $pendingLeaves ?? 0 }} En attente</span>
                        <span class="badge bg-success">{{ $approvedLeaves ?? 0 }} Approuvés</span>
                        <span class="badge bg-secondary text-dark">{{ $todayAttendances ?? 0 }} Pointages aujourd'hui</span>
                        <span class="badge bg-danger">{{ $rejectedLeaves ?? 0 }} Refusés</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <span class="avatar rounded-circle bg-primary mb-3">
                        <i class="ti ti-users fs-16"></i>
                    </span>
                    <h6 class="fs-13 fw-medium text-default mb-1">Employés</h6>
                    <h3 class="mb-3">{{ $employeeCount ?? 0 }}</h3>
                    <a href="{{ route('employees.index') }}" class="link-default">Voir la liste</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <span class="avatar rounded-circle bg-secondary mb-3">
                        <i class="ti ti-calendar-event fs-16"></i>
                    </span>
                    <h6 class="fs-13 fw-medium text-default mb-1">Demandes de congé</h6>
                    <h3 class="mb-3">{{ $leaveCount ?? 0 }}</h3>
                    <a href="{{ route('leaves.index') }}" class="link-default">Voir les demandes</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <span class="avatar rounded-circle bg-warning mb-3">
                        <i class="ti ti-clock fs-16"></i>
                    </span>
                    <h6 class="fs-13 fw-medium text-default mb-1">En attente</h6>
                    <h3 class="mb-3">{{ $pendingLeaves ?? 0 }}</h3>
                    <a href="{{ route('leaves.index') }}" class="link-default">Administrer</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <span class="avatar rounded-circle bg-success mb-3">
                        <i class="ti ti-check fs-16"></i>
                    </span>
                    <h6 class="fs-13 fw-medium text-default mb-1">Approuvés</h6>
                    <h3 class="mb-3">{{ $approvedLeaves ?? 0 }}</h3>
                    <a href="{{ route('leaves.index') }}" class="link-default">Voir l’historique</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <span class="avatar rounded-circle bg-info mb-3">
                        <i class="ti ti-file-text fs-16"></i>
                    </span>
                    <h6 class="fs-13 fw-medium text-default mb-1">Contrats</h6>
                    <h3 class="mb-3">{{ $contractCount ?? 0 }}</h3>
                    <a href="{{ route('contracts.index') }}" class="link-default">Gérer les contrats</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Derniers employés</h5>
                    <a href="{{ route('employees.index') }}" class="link-default">Voir tous</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Département</th>
                                    <th>Poste</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEmployees as $employee)
                                    <tr>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->department ?? '—' }}</td>
                                        <td>{{ $employee->position ?? '—' }}</td>
                                        <td>{{ $employee->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">Aucun employé recent.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Demandes de congé récentes</h5>
                    <a href="{{ route('leaves.index') }}" class="link-default">Voir toutes</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Employé</th>
                                    <th>Type</th>
                                    <th>Période</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLeaves as $leave)
                                    <tr>
                                        <td>{{ $leave->employee?->full_name ?? '—' }}</td>
                                        <td>{{ $leave->type }}</td>
                                        <td>{{ optional($leave->start_date)->format('d/m/Y') }} – {{ optional($leave->end_date)->format('d/m/Y') }}</td>
                                        <td>{{ $leave->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">Aucune demande récente.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Contrats récents</h5>
                    <a href="{{ route('contracts.index') }}" class="link-default">Voir tous</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Agent</th>
                                    <th>Numéro contrat</th>
                                    <th>Type</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Salaire de base</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContracts as $contract)
                                    <tr>
                                        <td>{{ $contract->employee?->full_name ?? '—' }}</td>
                                        <td>{{ $contract->num_contrat }}</td>
                                        <td>{{ $contract->type_contrat }}</td>
                                        <td>{{ optional($contract->date_debut)->format('d/m/Y') }}</td>
                                        <td>{{ optional($contract->date_fin)->format('d/m/Y') ?? '—' }}</td>
                                        <td>{{ number_format($contract->salaire_base, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3">Aucun contrat récent.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Projects -->
        <div class="col-xxl-8 col-xl-7 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-2 d-flex align-items-center justify-content-between flex-wrap">
                    <h5 class="mb-2">Projects</h5>
                    <div class="d-flex align-items-center">
                        <div class="dropdown mb-2">
                            <a href="javascript:void(0);"
                                class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                <i class="ti ti-calendar me-1"></i>This Week
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">This Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">This Week</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Today</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Team</th>
                                    <th>Hours</th>
                                    <th>Deadline</th>
                                    <th>Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-001</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Office Management App</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-02.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-03.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-05.jpg"
                                                    alt="img">
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="40"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td>12 Sep 2024</td>
                                    <td>
                                        <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>High
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-002</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Clinic Management </a></h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-06.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-07.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-08.jpg"
                                                    alt="img">
                                            </span>
                                            <a class="avatar bg-primary avatar-rounded text-fixed-white fs-10 fw-medium"
                                                href="javascript:void(0);">
                                                +1
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="40"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td>24 Oct 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Low
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-003</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Educational Platform</a></h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-06.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-08.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-09.jpg"
                                                    alt="img">
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">40/255 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>18 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-pink d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-004</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Chat & Call Mobile App</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-11.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-12.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-13.jpg"
                                                    alt="img">
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">35/155 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>19 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>High
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-005</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Travel Planning Website</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-17.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-18.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-19.jpg"
                                                    alt="img">
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">50/235 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>18 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-pink d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="project-details.html" class="link-default">PRO-006</a></td>
                                    <td>
                                        <h6 class="fw-medium"><a href="project-details.html">Service Booking Software</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-06.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-08.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-09.jpg"
                                                    alt="img">
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">40/255 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>20 Feb 2024</td>
                                    <td>
                                        <span class="badge badge-success d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Low
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0"><a href="project-details.html"
                                            class="link-default">PRO-008</a></td>
                                    <td class="border-0">
                                        <h6 class="fw-medium"><a href="project-details.html">Travel Planning Website</a>
                                        </h6>
                                    </td>
                                    <td class="border-0">
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-15.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-16.jpg"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-rounded">
                                                <img class="border border-white" src="assets/img/profiles/avatar-17.jpg"
                                                    alt="img">
                                            </span>
                                            <a class="avatar bg-primary avatar-rounded text-fixed-white fs-10 fw-medium"
                                                href="javascript:void(0);">
                                                +2
                                            </a>
                                        </div>
                                    </td>
                                    <td class="border-0">
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="45"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                                        </div>
                                    </td>
                                    <td class="border-0">17 Oct 2024</td>
                                    <td class="border-0">
                                        <span class="badge badge-pink d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Projects -->

        <!-- Tasks Statistics -->
        <div class="col-xxl-4 col-xl-5 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-2 d-flex align-items-center justify-content-between flex-wrap">
                    <h5 class="mb-2">Tasks Statistics</h5>
                    <div class="d-flex align-items-center">
                        <div class="dropdown mb-2">
                            <a href="javascript:void(0);"
                                class="btn btn-white border btn-sm d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                <i class="ti ti-calendar me-1"></i>This Week
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">This Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">This Week</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Today</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartjs-wrapper-demo position-relative mb-4">
                        <canvas id="mySemiDonutChart" height="190"></canvas>
                        <div class="position-absolute text-center attendance-canvas">
                            <p class="fs-13 mb-1">Total Tasks</p>
                            <h3>124/165</h3>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="border-end text-center me-2 pe-2 mb-3">
                            <p class="fs-13 d-inline-flex align-items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-warning"></i>Ongoing</p>
                            <h5>24%</h5>
                        </div>
                        <div class="border-end text-center me-2 pe-2 mb-3">
                            <p class="fs-13 d-inline-flex align-items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-info"></i>On Hold </p>
                            <h5>10%</h5>
                        </div>
                        <div class="border-end text-center me-2 pe-2 mb-3">
                            <p class="fs-13 d-inline-flex align-items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-danger"></i>Overdue</p>
                            <h5>16%</h5>
                        </div>
                        <div class="text-center me-2 pe-2 mb-3">
                            <p class="fs-13 d-inline-flex align-items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-success"></i>Ongoing</p>
                            <h5>40%</h5>
                        </div>
                    </div>
                    <div class="bg-dark br-5 p-3 pb-0 d-flex align-items-center justify-content-between">
                        <div class="mb-2">
                            <h4 class="text-success">389/689 hrs</h4>
                            <p class="fs-13 mb-0">Spent on Overall Tasks This Week</p>
                        </div>
                        <a href="tasks.html" class="btn btn-sm btn-light mb-2 text-nowrap">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tasks Statistics -->

    </div>

    <div class="row">

        <!-- Schedules -->
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
                <div class="card-body">
                    <h5 class="mb-3">Actions rapides</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">Ajouter un employé</a>
                        <a href="{{ route('leaves.create') }}" class="btn btn-success">Nouvelle demande de congé</a>
                        <a href="{{ route('contracts.create') }}" class="btn btn-info text-white">Ajouter un contrat</a>
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Pointage</a>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Voir les employés</a>
                        <a href="{{ route('leaves.index') }}" class="btn btn-outline-secondary">Voir les congés</a>
                        <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary">Voir les contrats</a>
                    </div>
                    <p class="text-muted mt-3 mb-0">Accédez rapidement aux actions RH courantes et gérez les contrats, congés et employés depuis un seul endroit.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
