<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    public function employe()
{
    return $this->belongsTo(Employe::class);
}
protected $fillable = [
    'employe_id',
    'type',
    'date_debut',
    'date_fin',
    'motif'
];
}