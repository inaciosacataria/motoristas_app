<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'privilegio',
        'celular',
        'active',
        'is_premium',
        'premium_count',
        'premium_date',
        'foto_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'premium_date' => 'datetime',
    ];

    /**
     * Relacionamentos
     */
    public function candidato()
    {
        return $this->hasOne(Candidatos::class);
    }

    public function empregador()
    {
        return $this->hasOne(Empregador::class);
    }

    public function anuncios()
    {
        return $this->hasMany(Anuncios::class);
    }

    public function candidaturas()
    {
        return $this->hasMany(Candidaturas_anuncios::class);
    }

    /**
     * Scopes para queries otimizadas
     */
    public function scopeActive($query)
    {
        return $query->where('active', 'Activo');
    }

    public function scopePremium($query)
    {
        return $query->where('is_premium', 'yes');
    }

    public function scopeCandidatos($query)
    {
        return $query->where('privilegio', 'candidato');
    }

    public function scopeEmpregadores($query)
    {
        return $query->where('privilegio', 'empregador');
    }

    /**
     * Verifica se o usuário é premium
     */
    public function isPremium()
    {
        return $this->is_premium === 'yes';
    }

    /**
     * Verifica se o usuário está ativo
     */
    public function isActive()
    {
        return $this->active === 'Activo';
    }
}
