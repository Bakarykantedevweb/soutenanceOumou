<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    public function service()
{
    return $this->belongsTo(Service::class);
}
    public function employes()
{
    return $this->hasMany(Employe::class);
}
protected $fillable = [
    'nom',
    'description',
    'service_id'
];
}
