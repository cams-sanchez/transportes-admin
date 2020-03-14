<?php

namespace App\Models;

use App\Traits\DefaultModelPropertiesChanger;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, DefaultModelPropertiesChanger;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function transportista()
    {
        return $this->belongsTo('App\Models\Transportista');
    }

    public function viaje()
    {
        return $this->belongsTo('App\Models\Viaje');
    }

    public function operador()
    {
        return $this->belongsTo('App\Models\Operadores');
    }

    public function tipoUsuario()
    {
        return $this->belongsTo('App\Models\TipoUsuarios');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\EstadosReplubicaCatalog');
    }

    public function equipoCelular()
    {
        return $this->hasOne('App\Models\EquipoCelular');
    }
}
