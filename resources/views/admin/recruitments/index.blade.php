@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Recrutement</h3>
    <a href="{{ route('recruitments.create') }}" class="btn btn-primary">Nouvelle offre</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Poste</th>
                    <th>Description</th>
                    <th>Date limite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recruitments as $rec)
                <tr>
                    <td>{{ $rec->poste }}</td>
                    <td>{{ $rec->description }}</td>
                    <td>{{ $rec->date_limite }}</td>
                    <td>
                        <a href="{{ route('recruitments.show', $rec) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('recruitments.edit', $rec) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('recruitments.destroy', $rec) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4">Aucune offre</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
