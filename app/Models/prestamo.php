<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'libro_id', 'fecha_prestamo', 'fecha_entrega'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}
