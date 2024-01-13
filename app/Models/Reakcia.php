<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reakcia extends Model
{
    use HasFactory;

    protected $table = 'reakcia';
    protected $fillable = [
        'id_prispevku',
        'reakcia',
        'autor_reakcie'
    ];

    public function oznam()
    {
        return $this->belongsTo(Oznam::class, 'id_prispevku', 'id');
    }

}
