<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $guarded = ['id','status'];

    const BORRADOR =1;
    const REVISION =2;
    const PUBLICADO =3;

    
    public function scopeDisciplina($query,$disciplina_id){
        if($disciplina_id){
            return $query->where('disciplina_id',$disciplina_id);
        }
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function subpagos30($tienda_id){
        return Pago::whereHas('pedidos', function ($query) use ($tienda_id) {
            $query->whereHas('ordens', function ($queryOrden) use ($tienda_id) {
                $queryOrden->whereHas('producto', function ($queryProducto) use ($tienda_id) {
                    $queryProducto->where('tienda_id', $tienda_id);
                });
            })->where('status', '>=', 4);
        })->where('created_at', '>=', now()->subDays(29))->get();
    }
    public function subpagos($tienda_id){
        return Pago::whereHas('pedidos', function ($query) use ($tienda_id) {
            $query->whereHas('ordens', function ($queryOrden) use ($tienda_id) {
                $queryOrden->whereHas('producto', function ($queryProducto) use ($tienda_id) {
                    $queryProducto->where('tienda_id', $tienda_id);
                });
            })->where('status', '>=', 4);
        })->get();
    }

    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

    public function disciplina(){
        return $this->belongsTo('App\Models\Disciplina');
    }

    public function categorias(){
        return $this->hasMany('App\Models\Category_product');
    }

    
}
