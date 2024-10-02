<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $categoria = "categorias";

    protected $fillable = [
        'categoria'
    ];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
