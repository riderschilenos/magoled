<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const ACTIVO =1;
    const INACTIVO =2;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function temas(){
        return $this->hasMany('App\Models\Tema');
    }
}
