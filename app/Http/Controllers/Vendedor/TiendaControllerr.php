<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\Category_product;
use App\Models\Disciplina;
use App\Models\Producto;
use App\Models\Serie;
use App\Models\Socio;
use App\Models\Tienda;
use App\Models\Vehiculo;
use App\Models\WhatsappMensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Http;

class TiendaControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       if(Cache::has('autos')){
            $autos = Cache::get('autos');
        }else{
            $autos = Vehiculo::where('status',6)
                            ->latest('id')->get()->take(3);
            Cache::put('autos',$autos);
         }

        
        if(Cache::has('series')){
            $series = Cache::get('series');
        }else{
            $series = Serie::where('status',3)->where('content','serie')->latest('id')->get()->take(4);
            Cache::put('series',$series);
         }


        if(Cache::has('riders')){
            $riders = Cache::get('riders');
        }else{
           $riders = Socio::join('users','socios.user_id','=','users.id')
            ->select('socios.*','users.name','users.email','users.updated_at')->where('status',1)
            ->orwhere('status',2)
            ->orderByRaw("CASE WHEN users.profile_photo_path IS NOT NULL THEN 0 ELSE 1 END, 
            CASE WHEN socios.created_at >= CURDATE() THEN 0 ELSE 1 END, 
            CASE WHEN socios.updated_at >= CURDATE() THEN 0 ELSE 1 END, 
            id DESC")->get()->take(4);
            Cache::put('riders',$riders);
         }

        if(auth()->user())
        {
        if(auth()->user()->socio)
        {
        $socio2 = Socio::where('user_id',auth()->user()->id)->first();
        }else{
        $socio2=null;
        }

        }
        else{
        $socio2=null;
        }

        $disciplinas= Disciplina::pluck('name','id');

        return view('tiendas.index',compact('socio2','disciplinas','riders','series','autos'));
    }

    public function index2()
    {   
      
        return view('tiendas.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplinas=Disciplina::pluck('name','id');

        return view('tiendas.create',compact('disciplinas'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'fono'=>'required',
            'slug'=>'required|unique:tiendas',
            'ubicacion'=>'required'

        ]);

        $tienda = Tienda::create($request->all());

        Cache::flush();

        if($request->file('file')){
        
            $nombre = Str::random(10).$request->file('file')->getClientOriginalName();
            $ruta = public_path().'/storage/tiendas/'.$nombre;
    
            Image::make($request->file('file'))->orientate()
                    ->resize(600, 600 , function($constraint){
                    $constraint->aspectRatio();
                    })
                    ->save($ruta);
            $tienda->update([
                        'logo'=>'tiendas/'.$nombre
                    ]);
            }

        $fono='569'.substr(str_replace(' ', '', $tienda->fono), -8);
        try {
            $token = env('WS_TOKEN');
            $phoneid= env('WS_PHONEID');
            $version='v16.0';
            $url="https://riderschilenos.cl/";
            $wsload=[
                    'messaging_product' => 'whatsapp',
                    "preview_url"=> false,
                    'to'=>'56963176726',
                    
                    'type'=>'template',
                        'template'=>[
                            'name'=>'nueva_tienda',
                            'language'=>[
                                'code'=>'es'],
                            'components'=>[ 
                                [
                                    'type'=>'body',
                                    'parameters'=>[
                                        [   //nombre
                                            'type'=>'text',
                                            'text'=> $tienda->nombre
                                        ],
                                        [   //nombre
                                            'type'=>'text',
                                            'text'=> $tienda->user->name
                                        ],
                                        [   //nombre
                                            'type'=>'text',
                                            'text'=> $fono
                                        ]
                                    ]
                                ]
                            ]
                        ]
                        
                    
                ];
                
            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
            
            $token = env('WS_TOKEN');
            $phoneid= env('WS_PHONEID');
            $version='v16.0';
            $url="https://riderschilenos.cl/";
            $payload=[
                'messaging_product' => 'whatsapp',
                "preview_url"=> false,
                'to'=>$fono,
                
                'type'=>'template',
                    'template'=>[
                        'name'=>'confirmacion_tienda',
                        'language'=>[
                            'code'=>'es'],
                    
                    ]
                
            ];
            
            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
            
            WhatsappMensaje::create(['numero'=> $fono,
            'mensaje'=>"¡Felicidades! Tu tienda ha sido registrada con éxito.",
            'type'=>'enviado']);


        } catch (\Throwable $th) {
            //throw $th;
        }
       

        return redirect()->route('tiendas.edit',$tienda);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tienda $tienda)
    {
        return view('tiendas.show',compact('tienda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tienda $tienda)
    {
        return view('tiendas.edit',compact('tienda'));
    }

    public function productos(Tienda $tienda)
    {
        return view('tiendas.productos',compact('tienda'));
    }

    public function disenos(Tienda $tienda)
    {
        return view('tiendas.disenos',compact('tienda'));
    }

    public function inteligente(Tienda $tienda)
    {   
        $category_products=Category_product::where('tienda_id',$tienda->id)->pluck('name','id');
        if ($category_products->count()>0) {
            return view('tiendas.cargainteligente',compact('tienda'));
        } else {
            return redirect()->route('tiendas.productos.categorias',$tienda);
        }

       
    }

    public function categorias(Tienda $tienda)
    {
        return view('tiendas.categorias',compact('tienda'));
    }

    public function manual(Request $request, Tienda $tienda)
    {   $disciplinas=Disciplina::pluck('name','id');
        $category_products=Category_product::where('tienda_id',$tienda->id)->pluck('name','id');

        if ($category_products->count()>0) {
            return view('tiendas.cargamanual',compact('disciplinas','category_products','tienda'));
        } else {
            return redirect()->route('tiendas.productos.categorias',$tienda);
        }
        
        
       
    }

    public function producto(Producto $producto)
    {   $disciplinas=Disciplina::pluck('name','id');
        $category_products=Category_product::where('tienda_id',$producto->tienda->id)->pluck('name','id');
        if ($producto->tienda_id) {
            $tienda=Tienda::find($producto->tienda_id);
        } else {
            $tienda=Tienda::find(4);
        }
        $ingresos=0;
        $mermas=0;
        foreach($producto->stocks as $stock){
            if($stock->detalle=='Ingreso'){
                $ingresos+=$stock->cantidad;
            }
            if($stock->detalle=='Merma'){
                $mermas+=$stock->cantidad;
            }
        }
        $ordenescount=0;
        foreach($producto->ordenes as $orden){
            if ($orden->pedido->status>3) {
                if ($orden->cantidad) {
                    $ordenescount+=$orden->cantidad;
                } else {
                    $ordenescount+=1;
                }
            }
        }

        $producto->update(['stock'=>($ingresos-$ordenescount-$mermas)]);
       

        return view('tiendas.editproduct',compact('disciplinas','category_products','producto','tienda'));
    }

    public function pedidos(Tienda $tienda)
    {
        return view('tiendas.pedidos',compact('tienda'));
    }

    public function pos(Tienda $tienda)
    {
        return view('tiendas.pos',compact('tienda'));
    }

    public function phonecases(Tienda $tienda)
    {
        return view('tiendas.carcasas',compact('tienda'));
    }

    public function printers(Tienda $tienda)
    {
        return view('tiendas.printing',compact('tienda'));
    }

    public function estadistica(Tienda $tienda)
    {
        return view('tiendas.estadistica',compact('tienda'));
    }

    public function staff(Tienda $tienda)
    {
        return view('tiendas.staff',compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
