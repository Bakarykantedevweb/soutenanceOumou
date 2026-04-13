<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contract;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'department',
        'position',
        'status',
        'hired_at',
        'salary',
    ];

    protected $casts = [
        'hired_at' => 'date',
    ];

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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
