<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidato_id',
        'empresa',
        'cargo',
        'data_inicio',
        'data_fim',
        'descricao',
        'atual',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    /**
     * Relacionamentos
     */
    public function candidato()
    {
        return $this->belongsTo(Candidatos::class, 'candidato_id');
    }
}
