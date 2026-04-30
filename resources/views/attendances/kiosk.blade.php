@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f7fe;
    }
    .kiosk-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .kiosk-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
        border: none;
        width: 100%;
        max-width: 500px;
    }
    .digital-clock {
        font-size: 4rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        font-family: 'Courier New', Courier, monospace;
    }
    .punch-input {
        font-size: 2rem;
        text-align: center;
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        padding: 15px;
        letter-spacing: 3px;
        font-weight: bold;
        color: #3b82f6;
    }
    .punch-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }
    .btn-punch {
        background: #3b82f6;
        border: none;
        border-radius: 15px;
        padding: 15px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }
    .btn-punch:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }
</style>

<div class="kiosk-container">
    <div class="kiosk-card text-center">
        <div class="mb-4">
            <h5 class="text-uppercase text-muted fw-bold" style="letter-spacing: 2px;">Station de Pointage</h5>
            <div id="clock" class="digital-clock">00:00:00</div>
            <p class="text-muted" id="current-date">Chargement de la date...</p>
        </div>

        <form action="{{ route('attendances.punch') }}" method="POST" id="punch-form">
            @csrf
            <div class="mb-4">
                <input type="text" name="matricule" class="form-control punch-input" 
                       placeholder="MATRICULE" required autofocus autocomplete="off">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-punch">
                    VALIDER LE POINTAGE
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-4 border-0 rounded-4 shadow-sm py-3">
                <h4 class="alert-heading h5 fw-bold mb-1">Succès !</h4>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-4 border-0 rounded-4 shadow-sm py-3">
                <h4 class="alert-heading h5 fw-bold mb-1">Attention</h4>
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('fr-FR', options);
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Auto-focus permanent sur l'input (pour les lecteurs de badges)
    document.addEventListener('click', () => {
        document.querySelector('.punch-input').focus();
    });
</script>
@endsection
