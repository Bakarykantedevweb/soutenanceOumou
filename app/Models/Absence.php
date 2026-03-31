<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    public function employe()
{
    return $this->belongsTo(Employe::class);
}
protected $fillable = [
    'employe_id',
    'date_absence',
    'motif'
];
}
