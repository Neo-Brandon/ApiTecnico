<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = "tareas";

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria_id',
        'estado_id',
        'completed_at',
    ];

    protected $dates = ['created_at', 'updated_at', 'completed_at'];

    //Escuchamos cuando se necesite actualizar el estado de la tarea
    protected static function booted(){
        static::updating(function($tarea){
            // Si el estado es 2 (completada) y completed_at es nulo, entonces registramos la fecha/hora
            if ($tarea->estado_id == 2 && is_null($tarea->completed_at)) {
                $tarea->completed_at = now();
            }
        });
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación muchos a muchos con técnicos
    public function usuarios()
    {
        //return $this->belongsToMany(User::class, 'tarea_tecnico'); // Cambia el nombre de la tabla pivote según corresponda
        return $this->belongsToMany(User::class, 'tarea_tecnico', 'tarea_id', 'usuario_id');
    }

    // Definir la relación con el modelo Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
