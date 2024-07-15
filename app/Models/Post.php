<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->BelongsTo('App\Models\User');
    }

    public function respuestatema(){
        return $this->BelongsTo('App\Models\Tema','replytema_id');
    }

    public function respuestapost(){
        return $this->BelongsTo('App\Models\Post','post_id');
    }

    
    
    public function likes(){
        return $this->MorphMany('App\Models\Like','likeable');
    }


}
