<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $withCount = ['posts'];

    // relacion uno a muchos inversa
    public function foro(){
        return $this->BelongsTo('App\Models\Foro');
    }

    public function user(){
        return $this->BelongsTo('App\Models\User');
    }

    public function likes(){
        return $this->MorphMany('App\Models\Like','likeable');
    }

    // relacion muchos a muchos inversa
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

   
}
