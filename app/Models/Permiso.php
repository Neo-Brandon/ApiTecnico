<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = "permisos";

    protected $fillable = [
        'tipo_permiso'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_permiso');
    }
}
