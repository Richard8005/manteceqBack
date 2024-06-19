<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'equipos';
    protected $primaryKey = 'codigo_inventario';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'ambiente_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    public function mantenimiento()
    {
        return $this->belongsToMany(Mantenimiento::class, 'mantenimiento_has_equipos','equipo_codigo_inventario', 'mantenimiento_id');
    }

}
