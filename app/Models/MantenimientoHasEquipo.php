<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantenimientoHasEquipo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mantenimiento_has_equipos';
    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class, 'mantenimiento_id', 'id');
    }
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_codigo_inventario', 'codigo_inventario');
    }
}
