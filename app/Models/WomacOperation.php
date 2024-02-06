<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WomacOperation extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'womac_has_operation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_womac',
        'id_patient',
        'id_operation',
        'id_visit',
    ];

    public $timestamps = false;

    public function pacient()
    {
        return $this->belongsTo(Pacient::class, 'id_patient', 'id');
    }


    public function operacia()
    {
        return $this->belongsTo(Operacia::class, 'id_operation', 'id');
    }


    public function womac()
    {
        return $this->belongsTo(Womac::class, 'id_womac', 'id');
    }
}
