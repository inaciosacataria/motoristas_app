<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empregador extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'empresa',
        'logotipo',
        'nuit',
        'sector_actividade',
        'representante',
        'telefone',
        'telefone_alt',
        'website',
        'endereco',
        'provincia_id',
        'sobre',
    ];

    /**
     * Relacionamentos
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincias::class, 'provincia_id');
    }

    public function anuncios()
    {
        return $this->hasMany(Anuncios::class, 'user_id', 'user_id');
    }
}
