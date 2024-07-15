<div x-data="setup()">
    @php
    $total=0;
    $total7=0;
    $total30=0;
    
    $gast7=0;
    $gast30=0;

    $comisiones=0;

    $comisionespagadas=0;

    $totalsuscrip=0; //ingresos por suscripcion

    $carcasas=0;
    $llaveros=0;
    $collares=0;
    $colgantes=0;
    $poleras=0;
    $polerones=0;
    $stickers=0;


    //gastos

    $comisionventas=0;
    $comisiondiseño=0;
    $comisionproduccion=0;

    $pendienteventas=0;
    $pendientediseño=0;
    $pendienteproduccion=0;

    $compracarcasas=0;
    $gastosgenerales=0;

    $totalsorteo=0;
    $totalnros=0;

    $totaldesafiorch=0;
    $participantesdesafiorch=0;
            if ($sortedTickets_anual) {

                foreach ($sortedTickets_anual as $ticket) {
                    
                        $totalsorteo+=$ticket->inscripcion;
                        foreach ($ticket->inscripcions as $inscripcion) {
                            $totalnros+=1;
                        }
                }
            }
            if ($tickets_anual) {
                
                foreach ($tickets_anual as $ticket) {
                    
                    $totaldesafiorch+=$ticket->inscripcion;
                    foreach ($ticket->inscripcions as $inscripcion) {
                        $participantesdesafiorch+=1;
                    }
                }
                
            }

    $stockcarcasas=0;
    $comprastotalcarc=0;
    $mermatotalcarc=0;
    if ($smartphones) {
    
        foreach ($smartphones as $smartphone) {
            $stockcarcasas+=$smartphone->stock;
            if ($smartphone->stocks) {
                foreach ($smartphone->stocks as $stock) {
                    if ($stock->detalle=="Ingreso") {
                        $comprastotalcarc+=$stock->cantidad;
                    } elseif($stock->detalle=="Merma") {
                        $mermatotalcarc+=$stock->cantidad;
                    }
                }
            }
        }
        
    }
                                    
    @endphp

    @foreach ($pedidos as $pedido)
        
        @if($pedido->pedidoable_type=="App\Models\Socio")
            @foreach ($pedido->ordens as $orden)
            @php

                if ($orden->producto) {
                    if($orden->producto->id==1 || $orden->producto->id==2 || $orden->producto->id==3|| $orden->producto->id==7  || $orden->producto->id==21 || $orden->producto->id==35 || $orden->producto->id==36 || $orden->producto->id==38 || $orden->producto->id==39 || $orden->producto->id==40 || $orden->producto->id==41 || $orden->producto->id==42){
                        if($orden->producto->id==35 ||$orden->producto->id==39){
                            $carcasas+=2;   
                        }else{
                            $carcasas+=1;   
                        }
                    }
                    elseif($orden->producto->id==4  || $orden->producto->id==34|| $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==38 || $orden->producto->id==40|| $orden->producto->id==45 || $orden->producto->id==46){
                        if($orden->producto->id==34){
                            $llaveros+=3;  
                        }elseif($orden->producto->id==45 || $orden->producto->id==46){
                            $llaveros+=2;  
                        }else{
                            $llaveros+=1;   
                        }
            
                    }
                    elseif($orden->producto->id==10|| $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==42){
                        $collares+=1; 
                    }
                    elseif($orden->producto->id==8 || $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==41){
                        $colgantes+=1; 
                    }
                    elseif($orden->producto->id==5 || $orden->producto->id==6){
                        $poleras+=1; 
                    }
                    elseif($orden->producto->id==13  || $orden->producto->id==14  || $orden->producto->id==19 || $orden->producto->id==21){
                        
                        $polerones+=1; 
                    }
                    elseif($orden->producto->id==9 || $orden->producto->id==44){
                        if($orden->producto->id==9){
                            $stickers+=2;   
                        }else{
                            $stickers+=1;   
                        }
                    
                    }
                }

                @endphp    
                @endforeach

            @endif

        @if($pedido->pedidoable_type=="App\Models\Invitado")
            @if ($pedido->ordens)
                @foreach ($pedido->ordens as $orden)
                    @php

                    if ($orden->producto) {
                        if($orden->producto->id==1 || $orden->producto->id==2 || $orden->producto->id==3|| $orden->producto->id==7  || $orden->producto->id==21 || $orden->producto->id==35 || $orden->producto->id==36 || $orden->producto->id==38 || $orden->producto->id==39 || $orden->producto->id==40 || $orden->producto->id==41 || $orden->producto->id==42){
                        if($orden->producto->id==35 ||$orden->producto->id==39){
                            $carcasas+=2;   
                        }else{
                            $carcasas+=1;   
                        }

                        }
                        elseif($orden->producto->id==4  || $orden->producto->id==34|| $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==38 || $orden->producto->id==40|| $orden->producto->id==45 || $orden->producto->id==46){
                            if($orden->producto->id==34){
                                $llaveros+=3;  
                            }elseif($orden->producto->id==45 || $orden->producto->id==46){
                                $llaveros+=2;  
                            }else{
                                $llaveros+=1;   
                            }
                
                        }
                        elseif($orden->producto->id==10|| $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==42){
                            $collares+=1; 
                        }
                        elseif($orden->producto->id==8 || $orden->producto->id==36 || $orden->producto->id==15 || $orden->producto->id==41){
                            $colgantes+=1; 
                        }
                        elseif($orden->producto->id==5 || $orden->producto->id==6){
                            $poleras+=1; 
                        }
                        elseif($orden->producto->id==13  || $orden->producto->id==14 || $orden->producto->id==11 || $orden->producto->id==12  || $orden->producto->id==19 || $orden->producto->id==21){
                            $polerones+=1; 
                        }
                        elseif($orden->producto->id==9 || $orden->producto->id==44){
                            if($orden->producto->id==9){
                                $stickers+=2;   
                            }else{
                                $stickers+=1;   
                            }
                        
                        }
                    }

                    @endphp    
                @endforeach
            @endif
        @endif

        @if($pedido->pedidoable_type=="App\Models\Socio")
            @if ($pedido->ordens)
                @foreach ($pedido->ordens as $orden)
                    @if ($orden->producto)
                    
                        @if($pedido->status==9)
                            @php
                                $comisionespagadas+=$orden->producto->comision_socio;
                            @endphp   

                        @else
                            @php
                                $comisiones+=$orden->producto->comision_socio;
                            @endphp   
                        @endif
                    @endif
                @endforeach
            @endif

        @endif
        @if($pedido->pedidoable_type=="App\Models\Invitado")
            @if ($pedido->ordens)
                @foreach ($pedido->ordens as $orden)
                    @if ($orden->producto)
                        @if($pedido->status==8)
                            @php  
                                $comisionespagadas+=$orden->producto->comision_invitado;
                            @endphp     

                        @else
                            @php  
                                $comisiones+=$orden->producto->comision_invitado;
                            @endphp  
                        @endif  
                    @endif
                @endforeach
            @endif
        @endif

    @endforeach
    @if ($suscripcions)
        
        @foreach ($suscripcions as $suscripcion)
            @php
                $totalsuscrip+=$suscripcion->precio;
            @endphp
        @endforeach

    @endif
    @foreach ($pagos as $pago)
        @php
               $total+=$pago->cantidad;
        @endphp
    @endforeach
    @foreach ($pagos7 as $pago)
        @php
               $total7+=$pago->cantidad;
        @endphp
    @endforeach
    @foreach ($pagos30 as $pago)
        @php
               $total30+=$pago->cantidad;
        @endphp
    @endforeach

    @foreach ($gastos7 as $gasto)
        @php
           
                $gast7+=$gasto->cantidad;   
                
        @endphp
    @endforeach
    @foreach ($gastos30 as $gasto)
        @php
           
                $gast30+=$gasto->cantidad;   
                
        @endphp
    @endforeach

    @foreach ($gastos as $gasto)
        @php
                if($gasto->gastotype_id==1){
                    $comisionventas+=$gasto->cantidad;   
                    if($gasto->estado==1){
                        $pendienteventas+=$gasto->cantidad;
                    }
                }
                elseif($gasto->gastotype_id==2){
                    $comisiondiseño+=$gasto->cantidad;
                    if($gasto->estado==1){
                        $pendientediseño+=$gasto->cantidad;
                    }
                }
                elseif($gasto->gastotype_id==3){
                    $comisionproduccion+=$gasto->cantidad;
                    if($gasto->estado==1){
                        $pendienteproduccion+=$gasto->cantidad;
                    }
                }
                elseif($gasto->gastotype_id==4){
                    $compracarcasas+=$gasto->cantidad;
                }
                elseif($gasto->gastotype_id>4){
                    $gastosgenerales+=$gasto->cantidad;
                }
        
        @endphp
    @endforeach

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- CSS de Swiper -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        @if ($tienda_id==4)
            
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Tus divs aquí -->
                    <div class="swiper-slide">
                        <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                        
                            <img class="w-40 m-auto opacity-100" src="https://png.monster/wp-content/uploads/2023/09/PNG.monsterapple-iphone-15-pro-photo%20png.png" alt="">
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">Venta da Carcasas</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">${{number_format($carcasas*15000-$comprastotalcarc*2500)}}</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Inversion actual ${{number_format($stockcarcasas*2500)}}</span>
                            </div>

                            <table class="w-full text-gray-600">
                                <tbody>
                                    <tr>
                                        <td class="py-2">Venta Total</td>
                                        <td class="text-gray-500">${{number_format($carcasas*15000)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Gasto Total</td>
                                        <td class="text-gray-500">{{number_format($comprastotalcarc*2500)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Ganancia</td>
                                        <td class="text-gray-500">{{number_format($carcasas*15000-$comprastotalcarc*2500)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Precio Unitario</td>
                                        <td class="text-gray-500">$15.000</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">C. Vendidas</td>
                                        <td class="text-gray-500">{{$carcasas}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Stock</td>
                                        <td class="text-gray-500">{{$stockcarcasas}}</td>
                                    
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    
                            <img class="w-80 m-auto opacity-100" src="https://b1748854.smushcdn.com/1748854/wp-content/uploads/2022/11/yamaha-ttr-110e-7.png?lossy=2&strip=0&webp=1" alt="">
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">Sorteo TTR 110</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">${{number_format($totalsorteo)}}</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Compared to last week $13,988</span>
                            </div>
        
                            <table class="w-full text-gray-600">
                                <tbody>
                                    <tr>
                                        <td class="py-2">Venta Total</td>
                                        <td class="text-gray-500">{{$totalnros}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Stock</td>
                                        <td class="text-gray-500">{{2000-$totalnros}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Precio Unitario</td>
                                        <td class="text-gray-500">$2.000</td>
                                    
                                    </tr>
                                
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    
                            <img class="w-60 m-auto opacity-100" src="https://www.shutterstock.com/image-photo/young-male-female-cyclists-leaning-600nw-1959417853.jpg" alt="">
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">D.O RidersChilenos</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">${{number_format($totaldesafiorch)}}</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Inversion actual $--</span>
                            </div>

                            <table class="w-full text-gray-600">
                                <tbody>
                                    <tr>
                                        <td class="py-2">Venta Total</td>
                                        <td class="text-gray-500">${{number_format($totaldesafiorch)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Gasto Total</td>
                                        <td class="text-gray-500">{{number_format(00)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Ganancia</td>
                                        <td class="text-gray-500">{{number_format($totaldesafiorch)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Precio Unitario</td>
                                        <td class="text-gray-500">$15.000</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Participantes</td>
                                        <td class="text-gray-500">{{$participantesdesafiorch}}</td>
                                    
                                    </tr>
                                
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    
                            <img class="w-60 m-auto opacity-100" src="https://www.shutterstock.com/image-photo/young-male-female-cyclists-leaning-600nw-1959417853.jpg" alt="">
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">D.O La Serena</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">${{number_format($carcasas*15000-$comprastotalcarc*2500)}}</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Inversion actual ${{number_format($stockcarcasas*2500)}}</span>
                            </div>

                            <table class="w-full text-gray-600">
                                <tbody>
                                    <tr>
                                        <td class="py-2">Venta Total</td>
                                        <td class="text-gray-500">${{number_format($carcasas*15000)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Gasto Total</td>
                                        <td class="text-gray-500">{{number_format($comprastotalcarc*2500)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Ganancia</td>
                                        <td class="text-gray-500">{{number_format($carcasas*15000-$comprastotalcarc*2500)}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Precio Unitario</td>
                                        <td class="text-gray-500">$15.000</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">C. Vendidas</td>
                                        <td class="text-gray-500">{{$carcasas}}</td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="py-2">Stock</td>
                                        <td class="text-gray-500">{{$stockcarcasas}}</td>
                                    
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="lg:h-full py-8 px-6 text-gray-600 rounded-xl border border-gray-200 bg-white">
                            <svg class="w-40 m-auto" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M27.9985 2.84071C31.2849 2.84071 34.539 3.488 37.5752 4.74562C40.6113 6.00324 43.3701 7.84657 45.6938 10.1703C48.0176 12.4941 49.861 15.2529 51.1186 18.289C52.3762 21.3252 53.0235 24.5793 53.0235 27.8657C53.0235 31.152 52.3762 34.4061 51.1186 37.4423C49.861 40.4785 48.0176 43.2372 45.6938 45.561C43.3701 47.8848 40.6113 49.7281 37.5752 50.9857C34.539 52.2433 31.2849 52.8906 27.9985 52.8906C24.7122 52.8906 21.4581 52.2433 18.4219 50.9857C15.3857 49.7281 12.627 47.8848 10.3032 45.561C7.97943 43.2372 6.1361 40.4785 4.87848 37.4423C3.62086 34.4061 2.97357 31.152 2.97357 27.8657C2.97357 24.5793 3.62086 21.3252 4.87848 18.289C6.13611 15.2529 7.97943 12.4941 10.3032 10.1703C12.627 7.84656 15.3857 6.00324 18.4219 4.74562C21.4581 3.488 24.7122 2.84071 27.9985 2.84071L27.9985 2.84071Z" stroke="#e4e4f2" stroke-width="3"/>
                                <path d="M27.301 2.50958C33.0386 2.35225 38.6614 4.13522 43.26 7.57004C47.8585 11.0049 51.1637 15.8907 52.641 21.437C54.1182 26.9834 53.6811 32.8659 51.4002 38.133C49.1194 43.4001 45.1283 47.7437 40.0726 50.4611C35.0169 53.1785 29.1923 54.1108 23.541 53.1071C17.8897 52.1034 12.7423 49.2225 8.93145 44.9305C5.12062 40.6384 2.86926 35.1861 2.54159 29.4558C2.21391 23.7254 3.82909 18.0521 7.12582 13.3536" stroke="url(#paint0_linear_622:13696)" stroke-width="5" stroke-linecap="round"/>
                                <path d="M13.3279 30.7467C13.3912 29.48 13.8346 28.5047 14.6579 27.8207C15.4939 27.124 16.5896 26.7757 17.9449 26.7757C18.8696 26.7757 19.6612 26.9404 20.3199 27.2697C20.9786 27.5864 21.4726 28.0234 21.8019 28.5807C22.1439 29.1254 22.3149 29.746 22.3149 30.4427C22.3149 31.2407 22.1059 31.9184 21.6879 32.4757C21.2826 33.0204 20.7949 33.3877 20.2249 33.5777V33.6537C20.9596 33.8817 21.5296 34.287 21.9349 34.8697C22.3529 35.4524 22.5619 36.1997 22.5619 37.1117C22.5619 37.8717 22.3846 38.5494 22.0299 39.1447C21.6879 39.74 21.1749 40.2087 20.4909 40.5507C19.8196 40.88 19.0089 41.0447 18.0589 41.0447C16.6276 41.0447 15.4622 40.6837 14.5629 39.9617C13.6636 39.2397 13.1886 38.1757 13.1379 36.7697H15.7219C15.7472 37.3904 15.9562 37.8907 16.3489 38.2707C16.7542 38.638 17.3052 38.8217 18.0019 38.8217C18.6479 38.8217 19.1419 38.6444 19.4839 38.2897C19.8386 37.9224 20.0159 37.4537 20.0159 36.8837C20.0159 36.1237 19.7752 35.579 19.2939 35.2497C18.8126 34.9204 18.0652 34.7557 17.0519 34.7557H16.5009V32.5707H17.0519C18.8506 32.5707 19.7499 31.969 19.7499 30.7657C19.7499 30.221 19.5852 29.7967 19.2559 29.4927C18.9392 29.1887 18.4769 29.0367 17.8689 29.0367C17.2736 29.0367 16.8112 29.2014 16.4819 29.5307C16.1652 29.8474 15.9816 30.2527 15.9309 30.7467H13.3279ZM25.6499 37.9477C26.8659 36.9344 27.8349 36.092 28.5569 35.4207C29.2789 34.7367 29.8806 34.0274 30.3619 33.2927C30.8433 32.558 31.0839 31.836 31.0839 31.1267C31.0839 30.4807 30.9319 29.974 30.6279 29.6067C30.3239 29.2394 29.8553 29.0557 29.2219 29.0557C28.5886 29.0557 28.1009 29.271 27.7589 29.7017C27.4169 30.1197 27.2396 30.696 27.2269 31.4307H24.6429C24.6936 29.9107 25.1433 28.758 25.9919 27.9727C26.8533 27.1874 27.9426 26.7947 29.2599 26.7947C30.7039 26.7947 31.8123 27.181 32.5849 27.9537C33.3576 28.7137 33.7439 29.7207 33.7439 30.9747C33.7439 31.9627 33.4779 32.9064 32.9459 33.8057C32.4139 34.705 31.8059 35.4904 31.1219 36.1617C30.4379 36.8204 29.5449 37.6184 28.4429 38.5557H34.0479V40.7597H24.6619V38.7837L25.6499 37.9477Z" fill="currentColor"/>
                                <path d="M36.1948 28.8842C36.1948 29.4438 36.2557 29.8634 36.3775 30.1432C36.4992 30.423 36.6967 30.5628 36.9699 30.5628C37.5097 30.5628 37.7796 30.0033 37.7796 28.8842C37.7796 27.7717 37.5097 27.2155 36.9699 27.2155C36.6967 27.2155 36.4992 27.3537 36.3775 27.6302C36.2557 27.9067 36.1948 28.3247 36.1948 28.8842ZM38.456 28.8842C38.456 29.6347 38.3293 30.2024 38.0758 30.5875C37.8257 30.9693 37.457 31.1602 36.9699 31.1602C36.5091 31.1602 36.1504 30.9644 35.8936 30.5727C35.6402 30.181 35.5135 29.6182 35.5135 28.8842C35.5135 28.1371 35.6352 27.5742 35.8788 27.1957C36.1257 26.8172 36.4894 26.6279 36.9699 26.6279C37.4472 26.6279 37.8142 26.8238 38.0709 27.2155C38.3276 27.6071 38.456 28.1634 38.456 28.8842ZM40.5395 31.7774C40.5395 32.3402 40.6003 32.7615 40.7221 33.0413C40.8439 33.3178 41.043 33.456 41.3195 33.456C41.596 33.456 41.8001 33.3194 41.9317 33.0462C42.0634 32.7697 42.1292 32.3468 42.1292 31.7774C42.1292 31.2145 42.0634 30.7982 41.9317 30.5283C41.8001 30.2551 41.596 30.1185 41.3195 30.1185C41.043 30.1185 40.8439 30.2551 40.7221 30.5283C40.6003 30.7982 40.5395 31.2145 40.5395 31.7774ZM42.8056 31.7774C42.8056 32.5245 42.6789 33.0906 42.4254 33.4757C42.1753 33.8575 41.8067 34.0484 41.3195 34.0484C40.8521 34.0484 40.4917 33.8526 40.2383 33.4609C39.9881 33.0693 39.8631 32.5081 39.8631 31.7774C39.8631 31.0302 39.9849 30.4674 40.2284 30.0889C40.4753 29.7104 40.839 29.5211 41.3195 29.5211C41.7869 29.5211 42.1506 29.7153 42.4106 30.1037C42.6739 30.4888 42.8056 31.0467 42.8056 31.7774ZM41.5318 26.7316L37.5278 33.9497H36.8021L40.8061 26.7316H41.5318Z" fill="white"/>
                                <path d="M23.5776 18.4198H25.5424V22.8407H23.5776V18.4198ZM30.4545 16.455H32.4193V22.8407H30.4545V16.455ZM27.0161 13.5078H28.9809V22.8407H27.0161V13.5078Z" fill="#6A6A9F"/>
                                <defs>
                                <linearGradient id="paint0_linear_622:13696" x1="5.54791e-07" y1="42.0001" x2="54.6039" y2="41.9535" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E323FF"/>
                                <stop offset="1" stop-color="#7517F8"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <div class="mt-6">
                                <h5 class="text-xl text-gray-700 text-center">Ask to customize</h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <h3 class="text-3xl font-bold text-gray-700">28</h3>
                                    <div class="flex items-end gap-1 text-green-500">
                                        <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>2%</span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">Compared to last week 13</span>
                            </div>
                            <table class="mt-6 -mb-2 w-full text-gray-600">
                                <tbody>
                                    <tr>
                                        <td class="py-2">Tailored ui</td>
                                        <td class="text-gray-500">896</td>
                                        <td>
                                            <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                                <defs>
                                                <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#E323FF"/>
                                                <stop offset="1" stop-color="#7517F8"/>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </td>   
                                    </tr>
                                    <tr>
                                        <td class="py-2">Customize</td>
                                        <td class="text-gray-500">1200</td>
                                        <td>
                                            <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                                <defs>
                                                <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#8AFF6C"/>
                                                <stop offset="1" stop-color="#02C751"/>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </td>   
                                    </tr>
                                    <tr>
                                        <td class="py-2">Other</td>
                                        <td class="text-gray-500">12</td>
                                        <td>
                                            <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                                <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                                <path d="M0 6C8.62687 6 6.85075 12.75 17 12.75C27.1493 12.75 25.3731 9 34 9C42.6269 9 42.262 13.875 49 13.875C55.5398 13.875 58.3731 6 67 6" stroke="url(#paint0_linear_622:13649)" stroke-width="2" stroke-linejoin="round"/>
                                                <defs>
                                                <linearGradient id="paint0_linear_622:13649" x1="67" y1="7.96873" x2="1.67368" y2="8.44377" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFD422"/>
                                                <stop offset="1" stop-color="#FF7D05"/>
                                                </linearGradient>
                                                </defs>
                                            </svg>
                                        </td>   
                                    </tr>
                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>
            </div>

        @endif
    
    

    <ul class="flex justify-center items-center my-4">
        <template x-for="(tab, index) in tabs" :key="index">
            <li class="cursor-pointer py-3 px-4 rounded transition"
                :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                x-text="tab"></li>
        </template>
    
    </ul>
  
    <div x-show="activeTab===0">
                            
        <figure class="highcharts-figure" class="mt-4 bg-white shadow">
            <div id="grafico"></div>
        </figure>
    
        <figure class="highcharts-figure" class="mt-4 bg-white shadow">
            <div id="container" class="mt-4"></div>
        </figure>
    
        <figure class="highcharts-figure" class="mt-4 bg-white shadow">
            <div id="balance" class="mt-4"></div>
        </figure>


    </div>
    <div x-show="activeTab===1">
        <div>
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="gastotreinta" wire:ignore>
                  
               </div>
            </figure>
         </div>
         <div>
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="gastouno" wire:ignore>
                  
               </div>
            </figure>
         </div>
         <div>
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="gastodos" wire:ignore>
                  
               </div>
            </figure>
         </div>

       Gastos Listado

    </div>
 
    
    

    

    @routeIs('admin.home')        
        <div class="container">
            <div class="card-header mb-4">
                <h1 class="text-center"><b>${{number_format($total+$totalsuscrip-($comisionventas+$comisiondiseño+$comisionproduccion+$compracarcasas+$gastosgenerales))}}</b></h1>

                <h3 class="block sm:hidden text-center">SEM: <b class="mr-4">${{number_format($total7-($gast7))}}</b> <br >MES: <b>${{number_format($total30-($gast30))}}</b></h3>
            
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <h2 class="text-center"><b>${{number_format($total+$totalsuscrip)}}</b></h2>
                    <h5 class="block sm:hidden text-center">SEM: <b class="mr-4">${{number_format($total7)}}</b> <br >MES: <b>${{number_format($total30)}}</b></h5>
                    <h5 class="text-center">INGRESOS</h5>
                    <div class="row justify-content-md-center">
                        <div class="mx-auto" min-width="80%">
                            <div class="card text-white bg-success mb-3" style="min-width: 16rem;">
                                <div class="card-header text-center"><b class="h1">${{number_format($total)}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title text-center">Ventas en Productos</h5>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="mx-auto" min-width="80%">
                            <div class="card text-white bg-success mb-3" style="min-width: 16rem;">
                                <div class="card-header text-center"><b class="h1">${{number_format($totalsuscrip)}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title text-center">Ventas en Suscripciones</h5>
                                
                            
                            </div>
                            </div>
                        </div>
                        {{-- comment
                        <div class="col">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header"><b class="h1">$253.000</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title">Ticketera RCH</h5><br>
                                
                            
                            </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col">
                    <h2 class="text-center"><b>${{number_format($comisionventas+$comisiondiseño+$comisionproduccion+$compracarcasas+$gastosgenerales)}}</b></h2>
                    <h5 class="block sm:hidden text-center">SEM: <b class="mr-4">${{number_format($gast7)}}</b> <br >MES: <b>${{number_format($gast30)}}</b></h5>
                    <h5 class="text-center">GASTOS</h5>
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-title px-2 pt-2"><b class="h1">${{number_format($comisionventas)}}</b></div>
                                @if ($pendienteventas>0)
                                    <div class="card-header"><b class="h5">- ${{number_format($pendienteventas)}} (Pendientes)</b></div>
                                @endif
                                
                            <div class="card-body">
                                
                                    <h5 class="card-title">Comisiones en ventas</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-title px-2 pt-2"><b class="h1">${{number_format($comisiondiseño)}}</b></div>
                                @if ($pendientediseño>0)
                                    <div class="card-header"><b class="h5">- ${{number_format($pendientediseño)}} (Pendientes)</b></div>
                                @endif
                            <div class="card-body">
                                
                                    <h5 class="card-title">Comisiones en diseño</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-title px-2 pt-2"><b class="h1">${{number_format($comisionproduccion)}}</b></div>
                                @if ($pendienteproduccion>0)
                                    <div class="card-header"><b class="h5">- ${{number_format($pendienteproduccion)}} (Pendientes)</b></div>
                                @endif
                            <div class="card-body">
                                
                                    <h5 class="card-title">Comisiones en producción</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-title px-2 pt-2"><b class="h1">${{number_format($compracarcasas)}}</b></div>
                                <div class="card-header"><b class="h5"> {{-- comment- $.000 (EXTRAS)--}}</b></div> 
                            <div class="card-body">
                                
                                    <h5 class="card-title">Carcasas</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-title px-2 pt-2"><b class="h1">${{number_format($gastosgenerales)}}</b></div>
                            <div class="card-header"><b class="h5"> {{-- comment- $.000 (EXTRAS)--}}</b></div> 
                            <div class="card-body">
                                
                                <a href="{{route('admin.gastos.create')}}" class="text-white"><h5 class="card-title">Gastos generales</h5></a><br>
                                
                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="card-header mb-4">
                <h3 class="text-center"><b>Ventas por Producto</b></h3>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">

                    <div class="row justify-content-md-center">
                        
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$carcasas}}</b></div>
                                <img src="" alt="">
                                <div class="card-body">
                                    
                                        <h5 class="card-title mx-auto">Carcasas</h5><br>
                                    
                                
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$polerones}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Polerones</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$llaveros}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Llaveros</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$collares}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Collares</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$colgantes}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Colgantes</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$poleras}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Poleras</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                       
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$stickers}}</b></div>
                            <div class="card-body">
                                
                                    <h5 class="card-title mx-auto">Styckers</h5><br>
                                
                            
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header text-center"><b class="h1">{{$vendedors->count()}}</b></div>
                            <div class="card-body">
                                
                                    <a href="{{route('admin.vendedors.index')}}" class="text-white"><h5 class="card-title mx-auto">Vendedores</h5></a><br>
                                
                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    @endif
    @routeIs('contabilidad')
    <div class="mt-4">
        <h3 class="text-center"><b>Ventas por Producto</b></h3>
    </div>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mb-12">
        <div class="mt-2 sm:mt-4 mb-4 w-full grid grid-cols-3 md:grid-cols-5 xl:grid-cols-5 gap-x-2 gap-y-2 items-center content-center">
     
  
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($carcasas)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Carcasas</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Carcasas</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($polerones)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Polerones</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Polerones</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($llaveros)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Llaveros</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Llaveros</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($collares)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Collares</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Collares</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($colgantes)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Colgantes</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Colgantes</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($poleras)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Poleras</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Poleras</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($stickers)}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Stickers</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Stickers</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 <div class="max-w-xl  bg-white shadow rounded-lg p-2 sm:p-6 xl:p-8 my-2">
                    <div class="flex items-center">
                       <div class="flex-shrink-0">
                          <span class="text-4xl sm:text-8xl leading-none font-bold text-gray-900">{{number_format($vendedors->count())}}</span>
                          <h3 class="sm:hidden text-base font-normal text-gray-500">Vendedores</h3>
                          <h3 class="hidden sm:block text-base font-normal text-gray-500">Vendedores</h3>
                       </div>
                       <div class="hidden sm:flex w-10 items-center justify-end flex-1 text-red-500 text-base font-bold cursor-pointer">
                          
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                       </div>
                    </div>
                 </div>
                 
              
        </div>

    </div>
    @endif


 



    @php
        $meses_letter=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agostro','Septiembre','Octubre','Noviembre','Diciembre','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agostro','Septiembre','Octubre','Noviembre','Diciembre'];
        $final_anual=$now->format('n')+12;
        $inicio_anual=$now->format('n')+1;
        $ingresomes=0;
        $meses=[];
        $meses_serie=[];

        foreach (range($inicio_anual,($final_anual)) as $number) {
            
                if($number>12){
                $nro=($number- 12);
                }else{
                $nro=$number;
                }  
            $meses[]=$nro;
            $meses_serie[]=$meses_letter[$nro-1];
            }
        $mesesbi=[];
        $mesesbi_serie=[];

        foreach (range($inicio_anual,($final_anual+12)) as $number) {
            
                if($number>12){
                $nro=($number- 12);
                }else{
                $nro=$number;
                }  
            $mesesbi[]=$nro;
            $mesesbi_serie[]=$meses_letter[$nro-1];
            }
        
        $ventas_anual=[];
        $ventas_anteanual=[];
           
                    
       
                    
       
             //  Calcular Ventas de los ultimos 2 años
             foreach ($meses as $mes) {
                $totalmes=0;
               
                foreach ($pagos_anteanual as $pago) {
                    
                    if($pago->created_at->format('n')==$mes){
                        $totalmes+=$pago->cantidad;
                    }
                }
                foreach ($suscripcions_anteanual as $suscripcion) {
                    
                    if($suscripcion->created_at->format('n')==$mes){
                        $totalmes+=$suscripcion->precio;
                    }
                }
                if ($tickets_anteanual) {
                    foreach ($tickets_anteanual as $ticket) {
                        
                        if($ticket->created_at->format('n')==$mes){
                            $totalmes+=$ticket->inscripcion;
                        }
                    }
                }
                if ($sortedTickets_anteanual) {
                    foreach ($sortedTickets_anteanual as $ticket) {
                        
                        if($ticket->created_at->format('n')==$mes){
                            $totalmes+=$ticket->inscripcion;
                        
                        }
                    }
                }
                

                $ventas_anteanual[]=$totalmes;
                
            }

             //  Calcular Ventas del ultimo año
            foreach ($meses as $mes) {
                $totalmes=0;
               //suma pagos
                foreach ($pagos_anual as $pago) {
                    
                    if($pago->created_at->format('n')==$mes){
                        $totalmes+=$pago->cantidad;
                    }
                        
                    
                }
                //Suma Suscripciones
                foreach ($suscripcions_anual as $suscripcion) {
                    
                    if($suscripcion->created_at->format('n')==$mes){
                        $totalmes+=$suscripcion->precio;
                    }
                        
                    
                }
                if ($tickets_anual) {
                  
                    foreach ($tickets_anual as $ticket) {
                        
                        if($ticket->created_at->format('n')==$mes){
                            $totalmes+=$ticket->inscripcion;
                        }
                    }
                }
                if ($sortedTickets_anual) {
                    foreach ($sortedTickets_anual as $ticket) {
                        
                        if($ticket->created_at->format('n')==$mes){
                            $totalmes+=$ticket->inscripcion;
                        }
                    }
                }
                $ventas_anteanual[]=$totalmes;
                $ventas_anual[]=$totalmes;
            }

        $gast_anual=[];
        $gast_anteanual=[];
        $seriegastos30=[];

        $gasto30_total=0;
        $gasto365_total=0;
        $gasto2_total=0;

        //calcular gastos ultimos 30 dias para grafico circular
        foreach($gastotypes as $gastotype){
            
            $gasto30_circular=0;
            $gasto30_cir=[];
                
                    //suma los gastos si corresponde al tipo de gasto que se esta sumando
                    foreach ($gastos30 as $pago) {
                        if ($pago->gastotype_id==$gastotype->id) {
                            $gasto30_circular+=$pago->cantidad;
                        }
             
                    }
                    //inserta el gasto si la suma es mayor a cero
                        if ($gasto30_circular>0) {
                            $gasto30_total+=$gasto30_circular;
                            $gasto30_cir[]=$gasto30_circular;
                            $seriegastos30[]=['name' =>$gastotype->name,
                                                    'y'=> $gasto30_circular];
                                }
        }

        //calcular gastos ultimos 2 años para grafico circular
        foreach($gastotypes as $gastotype){
                    $gastoanteanual_circular=0;
                    $gastoanteanual_cir=[];

                      //suma los gastos si corresponde al tipo de gasto que se esta sumando
                        foreach ($gastos_anteanual as $pago) {
                            
                            if($pago->gastotype_id==$gastotype->id){
                                $gastoanteanual_circular+=$pago->cantidad;
                            }

                        }

                        foreach ($gastos_anual as $pago) {
                                if($pago->gastotype_id==$gastotype->id){
                                    $gastoanteanual_circular+=$pago->cantidad;
                                }
                            
                        
                    }
                    if ($gastoanteanual_circular>0) {
                        $gasto2_total+=$gastoanteanual_circular;
                        $seriegastosanteanual[]=['name' =>$gastotype->name,
                                                'y'=> $gastoanteanual_circular];  

                    }
                }

        foreach($gastotypes as $gastotype){
           
                    $gastoanual_circular=0;

                        foreach ($gastos_anual as $pago) {
                            
                            if($pago->gastotype_id==$gastotype->id){
                                $gastoanual_circular+=$pago->cantidad;
                            }
                        
                    }
                    if ($gastoanual_circular>0) {
                        $gasto365_total+=$gastoanual_circular;
                        $seriegastosanual[]=['name' =>$gastotype->name,
                                        'y'=> $gastoanual_circular];  
                    }
        }

        foreach ($meses as $mes) {
                $totalmes=0;
                foreach ($gastos_anteanual as $pago) {
                    
                    if($pago->created_at->format('n')==$mes){
                        $totalmes+=$pago->cantidad;
                    }
                        
                    
                }

            $gast_anteanual[]=$totalmes;
            }
        foreach ($meses as $mes) {
                $totalmes=0;
                foreach ($gastos_anual as $pago) {
                    
                    if($pago->created_at->format('n')==$mes){
                        $totalmes+=$pago->cantidad;
                    }
                        
                    
                }
            $gast_anual[]=$totalmes;
            $gast_anteanual[]=$totalmes;
            }


        $final=$now->format('d')+date('t', strtotime($now."- 1 month"));
        $inicio=$now->format('d')+1;
        $dias=[];

        foreach (range($inicio,($final)) as $number) {
              
                if($number>date('t', strtotime($now."- 1 month"))){
                   $nro=($number- date('t', strtotime($now."- 1 month")));
                }else{
                   $nro=$number;
                }  
               $dias[]=$nro;
            }
        

        $ventas=[];
        foreach ($dias as $day) {
            $totaldia=0;
            foreach ($pagos30 as $pago) {
                if (intval($pago->created_at->format('d')) == $day) {
                    $totaldia+=$pago->cantidad;
                }
            }
            if ($suscripcions30) {
                foreach ($suscripcions30 as $suscripcion){
                    if (intval($suscripcion->created_at->format('d')) == $day) {
                        $totaldia+=$suscripcion->precio;
                    }
                }
            }
            if ($tickets30) {
              
                foreach ($tickets30 as $ticket){
                    if (intval($ticket->created_at->format('d')) == $day) {
                        $totaldia+=$ticket->inscripcion;
                    }
                }
                
            }
            if ($sortedTickets30) {
                foreach ($sortedTickets30 as $ticket){
                    if (intval($ticket->created_at->format('d')) == $day) {
                        $totaldia+=$ticket->inscripcion;
                    }
                }
            }
       
            $ventas[]=$totaldia;
            $ingresomes+=$totaldia;
            }

        $gastos=[];
        foreach ($dias as $day) {
            $totaldia=0;
            foreach ($gastos30 as $pago) {
                if (intval($pago->created_at->format('d')) == $day) {
                    $totaldia+=$pago->cantidad;
                }
            }
            $gastos[]=$totaldia;
            }



        //$ventas =[43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175];
       // $gastos =[24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434];
        $titventa30="Venta (".number_format($ingresomes).") - Gastos (".number_format($gasto30_total).") Ultimos 30 Dias";

       $titulo30="Ultimos 30 Días $".number_format($gasto30_total);
       $titulo365="Ultimos 365 Días $".number_format($gasto365_total);
       $titulo2="Ultimos 24 Meses $".number_format($gasto2_total);

    @endphp

    <script>
        function setup() {
        return {
        activeTab: 0,
        tabs: [
            "Ventas/Gastos",
            "Porcentaje Gastos"
        ]
        };
    };
    </script>
         <script>
            var total30 = <?php echo json_encode($titulo30) ?>;
            var total365 = <?php echo json_encode($titulo365) ?>;
            var total2 = <?php echo json_encode($titulo2) ?>;
            var seriegastos30 = <?php echo json_encode($seriegastos30) ?>;
            var seriegastosanual = <?php echo json_encode($seriegastosanual) ?>;
            var seriegastosanteanual = <?php echo json_encode($seriegastosanteanual) ?>;

            Highcharts.chart('gastotreinta', {
                chart: {
                   plotBackgroundColor: null,
                   plotBorderWidth: null,
                   plotShadow: false,
                   type: 'pie'
                },
                title: {
                    text: total30,
                    align: 'left'
                },
                tooltip: {
                   pointFormat: '<b><b>${point.y}</b>({point.percentage:.0f}%)<br/>',
                },
                accessibility: {
                   point: {
                         valueSuffix: '%'
                   }
                },
                plotOptions: {
                   pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                         },
                         showInLegend: true
                   }
                },
                series: [{
                   name: 'Brands',
                   colorByPoint: true,
                   data: seriegastos30
                }]
             });
             
             Highcharts.chart('gastodos', {
                chart: {
                   plotBackgroundColor: null,
                   plotBorderWidth: null,
                   plotShadow: false,
                   type: 'pie'
                },
                title: {
                   text: total2,
                   align: 'left'
                },
                tooltip: {
                   pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
                },
                accessibility: {
                   point: {
                         valueSuffix: '%'
                   }
                },
                plotOptions: {
                   pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                         },
                         showInLegend: true
                   }
                },
                series: [{
                   name: 'Brands',
                   colorByPoint: true,
                   data: seriegastosanteanual
                }]
             });
             
             Highcharts.chart('gastouno', {
                chart: {
                   plotBackgroundColor: null,
                   plotBorderWidth: null,
                   plotShadow: false,
                   type: 'pie'
                },
                title: {
                   text: total365,
                   align: 'left'
                },
                tooltip: {
                   pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
                },
                accessibility: {
                   point: {
                         valueSuffix: '%'
                   }
                },
                plotOptions: {
                   pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                         },
                         showInLegend: true
                   }
                },
                series: [{
                   name: 'Brands',
                   colorByPoint: true,
                   data: seriegastosanual
                }]
             });
             
            
        </script>

    <script>
        
        var titventa30 = <?php echo json_encode($titventa30) ?>;
        var ventas = <?php echo json_encode($ventas) ?>;
        var ventas_anual = <?php echo json_encode($ventas_anual) ?>;
        var ventas_anteanual = <?php echo json_encode($ventas_anteanual) ?>;
        var dias = <?php echo json_encode($dias) ?>;
        var meses = <?php echo json_encode($meses_serie) ?>;
        var mesesbi = <?php echo json_encode($mesesbi_serie) ?>;
        var gastos = <?php echo json_encode($gastos) ?>;
        var gastos_anual = <?php echo json_encode($gast_anual) ?>;
        var gastos_anteanual = <?php echo json_encode($gast_anteanual) ?>;
        var now = <?php echo intval($pago->created_at->format('d'))?>;

        Highcharts.chart('grafico', {
            chart: {
                    type: 'areaspline'
                },
            
            title: {
                        text: titventa30},
                       
            yAxis: {
                title: {
                    text: 'Pesos Chilenos'
                }
                                },
            colors: ['#01c600','#cd2300'],
            xAxis: {
                    categories: dias
                    },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                
            },

            series: [{
                name: 'Ventas',
                data: ventas
            }, {
                name: 'Gastos',
                data: gastos
            } ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

            });
        Highcharts.chart('container', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: 'Venta - Gastos Ultimos 12 Meses'
                },
                colors: ['#01c600','#cd2300'],
                xAxis: {
                    categories: meses
                    },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                  
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
                },
                yAxis: {
                    title: {
                        text: 'Pesos Chilenos'
                    }
                },
                plotOptions: {
                 
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Ventas',
                    data: ventas_anual
                }, {
                    name: 'Gastos',
                    data: gastos_anual
                }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            });

            Highcharts.chart('balance', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: 'Venta - Gastos Ultimos 24 Meses'
                },
                colors: ['#01c600','#cd2300'],
                xAxis: {
                    categories: mesesbi
                    },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                  
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
                },
                yAxis: {
                    title: {
                        text: 'Pesos Chilenos'
                    }
                },
                plotOptions: {
                 
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Ventas',
                    data: ventas_anteanual
                }, {
                    name: 'Gastos',
                    data: gastos_anteanual
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
                        
    </script>

    <!-- JS de Swiper -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        
        <script>
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 10,
                centeredSlides: false,
                grabCursor: false,
                breakpoints: {
                    // Configura el comportamiento en dispositivos móviles
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        centeredSlides: false,
                    },
                    // Configura el comportamiento en vista de escritorio
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        centeredSlides: false,
                        freeMode: true,
                    }
                },
                // Otras opciones que desees configurar
            });
        </script>

</div>
