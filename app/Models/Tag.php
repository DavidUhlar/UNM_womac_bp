<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    protected $fillable = ['nazov'];

    public $timestamps = false;
    public function oznam()
    {
        return $this->belongsToMany(Oznam::class, 'has_tag', 'id_tagu', 'id')
            ->withPivot('id_tagu', 'id_prispevku');
    }

}
