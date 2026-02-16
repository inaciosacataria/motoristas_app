<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'datanascimento',
        'telefone_alt',
        'endereco',
        'provincia_id',
        'sexo',
        'categoria_id',
        'numero_carta_conducao',
        'validade_conducao',
        'inibicao_anterior',
        'inibicao_motivo',
        'envolvimento_acidente',
        'acidente_descricao',
        'grau_academico',
        'nacionalidade',
        'cv',
    ];

    protected $casts = [
        'datanascimento' => 'date',
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

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencias::class, 'candidato_id');
    }

    public function idiomas()
    {
        return $this->hasMany(Idiomas::class, 'candidato_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'candidato_id');
    }

    /**
     * Calcula a idade do candidato
     */
    public function getIdadeAttribute()
    {
        return $this->datanascimento->age;
    }

    /**
     * Calcula o progresso do perfil
     */
    public function getProgressoPerfilAttribute()
    {
        $progresso = 40; // Base: dados pessoais e contato

        if ($this->experiencias()->count() > 0) $progresso += 20;
        if ($this->idiomas()->count() > 0) $progresso += 20;
        if ($this->documentos()->count() > 0) $progresso += 20;

        return $progresso;
    }
}
