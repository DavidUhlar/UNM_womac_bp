<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pacient extends Model
{

    protected $table = 'd_pacient';

    // Define the relationship with Operacia
    public function operacie()
    {
        return $this->hasMany(Operacia::class, 'id_pac', 'id');
    }



}

