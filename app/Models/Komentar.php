<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $fillable = [
        'id_prispevku',
        'obsah',
        'autor'
    ];

    public function oznam()
    {
        return $this->belongsTo(Oznam::class, 'id_prispevku', 'id');
    }

}
