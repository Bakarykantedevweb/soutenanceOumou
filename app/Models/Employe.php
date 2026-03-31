<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    public function service()
{
    return $this->belongsTo(Service::class);
}
    public function poste()
{
    return $this->belongsTo(Poste::class);
} 
    public function conges()
{
    return $this->hasMany(Conge::class);
}
    public function absences()
{
    return $this->hasMany(Absence::class);
}
    protected $fillable = [
    'nom',
    'prenom',
    'email',
    'telephone',
    'service_id',
    'poste_id',
    'date_embauche'
    ];
}
