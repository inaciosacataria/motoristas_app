<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idiomas extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidato_id',
        'idioma',
        'nivel',
    ];

    /**
     * Relacionamentos
     */
    public function candidato()
    {
        return $this->belongsTo(Candidatos::class, 'candidato_id');
    }
}
