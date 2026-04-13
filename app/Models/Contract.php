<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Employee;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'num_contrat',
        'type_contrat',
        'date_debut',
        'date_fin',
        'salaire_base',
        'situation_matrimoniale',
        'diplome',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'salaire_base' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'agent_id');
    }
}
