<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WomacResult extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'womac_result';

//    protected $primaryKey = ['id_womac', 'result_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_womac',
        'result_name',
        'result_value',
    ];

    public $timestamps = false;


    public function womac()
    {
        return $this->belongsTo(Womac::class, 'id_womac', 'id_womac');
    }
}
