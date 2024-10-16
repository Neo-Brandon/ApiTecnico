<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaTecnico extends Model
{
    use HasFactory;

    protected $table = 'tarea_tecnico';

    protected $fillable = ['tarea_id', 'usuario_id'];

    // Relación con el modelo Nota
    public function notas()
    {
        return $this->hasMany(Nota::class, 'tarea_tecnico_id');
    }

    // Relación con el modelo Tarea
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
