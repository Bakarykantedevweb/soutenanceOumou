<h2>Alerte : Contrat CDD arrivant à expiration</h2>
<p>Bonjour,</p>
<p>Le contrat CDD de l'agent <strong>{{ $contract->employee?->full_name ?? $contract->agent_id }}</strong> (N° {{ $contract->num_contrat }}) arrive à expiration dans <strong>{{ $joursRestants }} jours</strong> (fin prévue le {{ $contract->date_fin->format('d/m/Y') }}).</p>
<p>Merci de prendre les dispositions nécessaires.</p>
<p>Cordialement,<br>Orange Mali RH</p>
