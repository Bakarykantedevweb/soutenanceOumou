<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge Employé - {{ $employee->full_name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .badge-container {
            width: 350px;
            height: 550px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin: 50px auto;
            overflow: hidden;
            position: relative;
            border: 1px solid #eee;
        }
        .badge-header {
            background: #ff7900; /* Orange Orange */
            height: 120px;
            padding: 20px;
            text-align: center;
            color: white;
        }
        .badge-header img { width: 100px; margin-bottom: 10px; }
        .avatar-container {
            width: 150px;
            height: 150px;
            margin: -75px auto 20px;
            background: white;
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }
        .avatar-container img { width: 100%; border-radius: 50%; }
        .badge-body { text-align: center; padding: 20px; }
        .employee-name { font-size: 1.5rem; font-weight: 800; color: #333; margin-bottom: 5px; text-transform: uppercase; }
        .employee-position { font-size: 1rem; color: #ff7900; font-weight: 600; margin-bottom: 20px; }
        .qr-container { background: #f8f9fa; padding: 15px; border-radius: 15px; display: inline-block; margin-top: 10px; }
        .qr-container img { width: 120px; }
        .matricule { font-family: 'Courier New', Courier, monospace; font-weight: bold; margin-top: 10px; font-size: 0.9rem; color: #666; }
        .footer-text { position: absolute; bottom: 20px; width: 100%; text-align: center; font-size: 0.7rem; color: #999; text-transform: uppercase; letter-spacing: 1px; }
        
        @media print {
            .no-print { display: none; }
            body { background: white; margin: 0; padding: 0; }
            .badge-container { margin: 0; box-shadow: none; border: 1px solid #ccc; }
        }
    </style>
</head>
<body>

    <div class="container no-print mt-4 text-center">
        <button onclick="window.print()" class="btn btn-primary btn-lg shadow">
            <i class="bi bi-printer"></i> Imprimer le Badge
        </button>
        <a href="{{ route('employees.show', $employee) }}" class="btn btn-outline-secondary btn-lg ms-2">Retour</a>
    </div>

    <div class="badge-container">
        <div class="badge-header">
            <h5 class="fw-bold mb-0">ORANGE MALI</h5>
            <small>Service des Ressources Humaines</small>
        </div>
        
        <div class="avatar-container">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->full_name) }}&background=000&color=fff&size=200" alt="Avatar">
        </div>

        <div class="badge-body">
            <div class="employee-name">{{ $employee->last_name }}</div>
            <div class="employee-name" style="font-size: 1.2rem; font-weight: 400;">{{ $employee->first_name }}</div>
            <div class="employee-position">{{ $employee->position ?? 'Agent de Service' }}</div>
            
            <div class="qr-container">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $employee->matricule }}" alt="QR Code">
                <div class="matricule">{{ $employee->matricule }}</div>
            </div>
        </div>

        <div class="footer-text">
            Badge strictement personnel - Orange Mali © 2026
        </div>
    </div>

</body>
</html>
