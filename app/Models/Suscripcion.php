<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function suscripcionable(){
        return $this->morphTo();
    }

    public function socio(){
        return $this->morphTo('suscripcionable', 'suscripcionable_type', 'suscripcionable_id');
    }
    
}
