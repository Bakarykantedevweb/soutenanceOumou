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

    protected static function booted()
    {
        static::creating(function (self $contract) {
            if (empty($contract->num_contrat)) {
                $contract->num_contrat = self::generateContractNumber();
            }
        });
    }

    public static function generateContractNumber(): string
    {
        do {
            $number = 'CNT-' . now()->format('Ymd') . '-' . mt_rand(100, 999);
        } while (self::where('num_contrat', $number)->exists());

        return $number;
    }

    public function getSalaireAvecAugmentationAttribute(): ?float
    {
        if (! $this->date_debut || ! $this->salaire_base) {
            return null;
        }

        $months = $this->date_debut->diffInMonths(now());
        return round($this->salaire_base * pow(1.025, $months), 2);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'agent_id');
    }
}
