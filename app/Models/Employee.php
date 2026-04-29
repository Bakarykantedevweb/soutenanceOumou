<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contract;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'first_name',
        'last_name',
        'email',
        'date_naissance',
        'phone',
        'department',
        'position',
        'hired_at',
    ];

    protected $casts = [
        'hired_at' => 'date',
        'date_naissance' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function (self $employee) {
            if (empty($employee->matricule)) {
                $employee->matricule = self::generateMatricule();
            }
        });
    }

    public static function generateMatricule(): string
    {
        do {
            $matricule = 'EMP' . now()->format('YmdHis') . mt_rand(1000, 9999);
        } while (self::where('matricule', $matricule)->exists());

        return $matricule;
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'agent_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
