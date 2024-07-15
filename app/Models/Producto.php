<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id','status'];

    const BORRADOR =1;
    const REVISION =2;
    const PUBLICADO =3;

    //relacion uno a muchos

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeFilter($query,$filters){
        $query->when($filters['tiendaid'] ?? null,function($query,$tiendaid){
                $query->where('tienda_id',$tiendaid);
            })->when($filters['personalizable']  || $filters['stock'] , function ($query) use ($filters) {
            $query->where(function ($query) use ($filters) {
                if ($filters['personalizable'] && $filters['stock']) {
                   
                }elseif ($filters['personalizable']) {
                    $query->where('personalizable', 'si');
                } elseif ($filters['stock']) {
                    $query->where('personalizable', 'no');
                }
            });
            
            
        });
    }

    public function ordenes(){
        return $this->hasMany('App\Models\Orden');
    }

    //relacion uno a muchos inversa 

    public function disciplina(){
        return $this->belongsTo('App\Models\Disciplina');
    }

    public function tienda(){
        return $this->belongsTo('App\Models\Tienda');
    }

    public function category_product(){
        return $this->belongsTo('App\Models\Category_product');
    }

    //relacion uno a uno polimorfica
    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function stocks(){
        return $this->MorphMany('App\Models\Stock','stockable');
    }

}
