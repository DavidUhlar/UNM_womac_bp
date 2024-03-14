<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Womac extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'womac';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_womac',

        'date_visit',
        'date_womac',


        'note',

        'created_at',
        'updated_at',
        'deleted_at',
        'closed_at',
        'locked_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'closed_by',
        'locked_by',
    ];

    public $timestamps = false;




    public function operacie()
    {
        return $this->belongsToMany(Operacia::class, 'womac_has_operation', 'id_womac', 'id_operation');
    }

    public function result()
    {
        return $this->hasMany(WomacResult::class, 'id_womac', 'id');
    }

    public function answers()
    {
        return $this->hasMany(WomacAnswers::class, 'id_womac', 'id');
    }
}
