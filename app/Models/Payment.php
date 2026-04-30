<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'libelle',
        'montant',
        'date_paiement',
        'status',
        'description',
    ];

    protected $casts = [
        'date_paiement' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
