<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Operacia extends Model
{
    protected $table = 'd_operacia';

    // Define the relationship through the pivot table
    public function womac()
    {
        return $this->belongsToMany(Womac::class, 'womac_has_operation', 'id_operation', 'id_womac');
    }

    // Define the relationship with Pacient
    public function pacient()
    {
        return $this->belongsTo(Pacient::class, 'id_pac', 'id');
    }
}
