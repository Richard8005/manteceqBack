<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mantenimientos';
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'clase_id', 'id');
    }
    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'mantenimiento_has_equipos', 'mantenimiento_id', 'equipo_codigo_inventario');
    }
}
