<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WomacAnswers extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'womac_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_womac',

        'answer_01',
        'answer_02',
        'answer_03',
        'answer_04',
        'answer_05',
        'answer_06',
        'answer_07',
        'answer_08',
        'answer_09',
        'answer_10',
        'answer_11',
        'answer_12',
        'answer_13',
        'answer_14',
        'answer_15',
        'answer_16',
        'answer_17',
        'answer_18',
        'answer_19',
        'answer_20',
        'answer_21',
        'answer_22',
        'answer_23',
        'answer_24',

        'filled',

        'created_at',
        'updated_at',
        'deleted_at',
        'closed_at',

        'created_by',
        'updated_by',
        'deleted_by',
        'closed_by',

    ];

    public $timestamps = false;


}
