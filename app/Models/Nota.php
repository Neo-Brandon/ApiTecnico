<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;


    // Definir la tabla asociada
    protected $table = 'notas';

    // Campos que se pueden llenar en masa (mass assignable)
    protected $fillable = ['contenido', 'tarea_tecnico_id'];

    /**
     * Relación con la tabla tarea_tecnico.
     * Una nota pertenece a una asignación específica de un técnico a una tarea.
     */
    public function tareaTecnico()
    {
        return $this->belongsTo(TareaTecnico::class, 'tarea_tecnico_id');
    }
}
