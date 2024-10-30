<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'informe';

    // Campos que se pueden llenar en masa (mass assignable)
    protected $fillable = [
        'titulo',
        'contenido',
        'image_path_1',
        'image_path_2',
        'image_path_3',
        'tarea_tecnico_id'
        ];

    /**
     * Relación con la tabla tarea_tecnico.
     * Una nota pertenece a una asignación específica de un técnico a una tarea.
     */
    public function tareaTecnico()
    {
        return $this->belongsTo(TareaTecnico::class, 'tarea_tecnico_id');
    }

    
    
}
