<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Notifications\UpdateUsersonline;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {    $expiresAt = now()->addMinutes(2); /* already given time here we already set 2 min. */
        if (Auth::check()) {
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
  
            /* user last seen */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()]);

            $users=[];
            $allusers=User::all();
            foreach($allusers as $item){
                if(Cache::has('user-is-online-' . $item->id) && $item->id!=auth()->user()->id){
                    $users[]=User::find($item->id);
                }
            }
                        
            if(env('APP_ENV')=='production'){
                Notification::send($users, new UpdateUsersonline());
           }

        }else{
            $numeros = range(1, 100);
            $invitadoId = $request->cookie('invitado-id');
            // Iterar sobre la matriz utilizando foreach
            foreach ($numeros as $numero) {
                if(Cache::has('invitado-is-online-'.$numero)){
                    if($numero==$invitadoId){
                        break;
                    }
                }else{

                    Cache::put('invitado-is-online-'.$numero, true, $expiresAt);

                    if (!$request->cookie('invitado-id')) {
                        // Generar un identificador único para el usuario invitado
            
                        // Crear la cookie y establecerla en la respuesta
                        $cookie = Cookie::make('invitado-id', $numero, 360); // 60 minutos de duración
                        $response = $next($request);

                        $users=[];
                        $allusers=User::all();
                        foreach($allusers as $item){
                            if(Cache::has('user-is-online-' . $item->id)){
                                $users[]=User::find($item->id);
                            }
                        }
                        
                        if(env('APP_ENV')=='production'){
                             Notification::send($users, new UpdateUsersonline());
                        }
            
                        // Adjuntar la cookie a la respuesta
                        return $response->withCookie($cookie);
                    }
                    break;
                }
            }
        }
  
        return $next($request);
    }
}
