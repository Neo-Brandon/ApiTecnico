<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $fillable = [
        'nombre',
        'correo',
        'pass'
    ];
    
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'usuario_permiso');
    }

    // Relación muchos a muchos con tareas
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tarea_tecnico');
    }
}
