<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncios extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'slug',
        'validade',
        'descricao',
        'estado_anuncio',
        'forma_de_candidatura',
        'categoria_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::random(16);
            }
        });
    }

    protected $casts = [
        'validade' => 'date',
    ];

    /**
     * Relacionamentos
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function empregador()
    {
        return $this->belongsTo(Empregador::class, 'user_id', 'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function provincias()
    {
        return $this->belongsToMany(Provincias::class, 'anuncios_provincias', 'anuncio_id', 'provincia_id');
    }

    public function candidaturas()
    {
        return $this->hasMany(Candidaturas_anuncios::class, 'anuncio_id');
    }

    /**
     * Scopes
     */
    public function scopePublicado($query)
    {
        return $query->where('estado_anuncio', 'Publicado');
    }

    public function scopeValido($query)
    {
        return $query->where('validade', '>=', now());
    }

    public function scopeRecente($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Verifica se o anúncio está válido
     */
    public function isValido()
    {
        return $this->validade >= now() && $this->estado_anuncio === 'Publicado';
    }
}
