<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Operacia extends Model
{
    protected $table = 'd_operacia';


    public function womac()
    {
        return $this->belongsToMany(Womac::class, 'womac_has_operation', 'id_operation', 'id_womac');
//        return $this->hasMany(Womac::class, 'id_operation', 'id');
    }


    public function pacient()
    {
        return $this->belongsTo(Pacient::class, 'id_pac', 'id');
    }
}
