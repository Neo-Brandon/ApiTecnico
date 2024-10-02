<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación muchos a muchos con técnicos
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'tarea_tecnico'); // Cambia el nombre de la tabla pivote según corresponda
    }
}
