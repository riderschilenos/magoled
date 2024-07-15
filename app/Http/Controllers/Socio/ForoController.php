<?php

namespace App\Http\Controllers\Socio;

use App\Http\Controllers\Controller;
use App\Models\Foro;
use App\Models\Post;
use App\Models\Socio;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ForoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $foros=Foro::all();
        $temas=Tema::all();
        $posts=Post::all();
        $socios=Socio::all();
        return view('socio.foro.index',compact('foros','socios','temas','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socio.foro.create');
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
            'titulo'=>'required',
            'slug'=>'required|unique:series',
            'descripcion'=>'required',
            'categoria'=>'required',

        ]);

        $foro = Foro::create($request->all());

        Cache::flush();

        return redirect()->route('foros.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Foro $foro)
    {   $temas=Tema::where('foro_id',$foro->id)->paginate(25);
        $foro->update(['vistas'=>$foro->vistas+1]);
        return view('socio.foro.show',compact('foro','temas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Foro $foro)
    {
        return view('socio.foro.edit',compact('foro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foro $foro)
    {
        $foro->update($request->all());

        return redirect()->route('foros.create');
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
