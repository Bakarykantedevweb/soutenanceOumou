<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
    'employe_id',
    'date'
];

// Relation avec employé
public function employe()
{
    return $this->belongsTo(Employe::class);
}
}
