<div class="container-fluid px-0">
    {{-- <div class="d-flex justify-content-center align-items-center mb-4" style="background-image: url({{asset('img/catalogo/slide.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center;height: 300px;">
        <h2 class="text-white fw-bold" style="text-align: center; font-weight: lighter; font-size: 3.5rem;">Detalles del producto</h2> 
    </div> --}}
    <div class="d-flex justify-content-center align-items-center mb-4" style="background-color:slategrey; height: 300px;">
        <h2 class="text-white fw-bold" style="text-align: center; font-weight: lighter; font-size: 3.5rem;">Detalles del producto</h2> 
    </div>
    <div class="d-flex justify-content-center">
        <div class="d-flex" style="margin-right: 50px">
            <div style="width: 502px; height: 502px; background-image: url({{asset($url_imagen)}}); background-repeat: no-repeat; background-size: cover; background-position: center; margin-right: 8px;">
                
            </div>
            <div class="d-flex flex-column">
                <div wire:click="cambiarImagen('{{$producto->imagen}}')" style="cursor: pointer; width: 94px; height: 94px; background-image: url({{asset($producto->imagen)}}); background-repeat: no-repeat; background-size: cover; background-position: center; margin-bottom: 8px">
                </div>

                <div wire:click="cambiarImagen('{{$producto->imagen1}}')" style="cursor: pointer; width: 94px; height: 94px; background-image: url({{asset($producto->imagen1)}}); background-repeat: no-repeat; background-size: cover; background-position: center; margin-bottom: 8px">
                </div>

                <div wire:click="cambiarImagen('{{$producto->imagen2}}')" style="cursor: pointer; width: 94px; height: 94px; background-image: url({{asset($producto->imagen2)}}); background-repeat: no-repeat; background-size: cover; background-position: center; margin-bottom: 8px">
                </div>

                <div wire:click="cambiarImagen('{{$producto->imagen3}}')" style="cursor: pointer; width: 94px; height: 94px; background-image: url({{asset($producto->imagen3)}}); background-repeat: no-repeat; background-size: cover; background-position: center; margin-bottom: 8px">
                </div>

                <div wire:click="cambiarImagen('{{$producto->imagen4}}')" style="cursor: pointer; width: 94px; height: 94px; background-image: url({{asset($producto->imagen4)}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                </div>
            </div>
        </div>
        <div style="width: 400px; height: 400px; margin-right: 8px;">
            <h2 class="text-danger">{{$producto->nombre}}</h2>
            <h3 class="fw-bold fs-1">S/. {{$producto->precio}}</h3>
            <h4>{{$producto->descripcion}}</h4>
            <h5>Stock: {{$producto->stock}}</h5>
            <button class="btn btn-success" wire:click.prevent="store({{$producto->id}}, '{{$producto->nombre}}', {{$producto->precio}})">Agregar al carrito</button>
            <button wire:click="redireccionarVistaCatalogo()" class="btn btn-primary">Regresar</button>
        </div>
    </div>
    <hr>
    <h4 class="mt-4 mb-3">Productos relacionados</h4>
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" >
            @foreach ($productos_relacionados as $item)
                <div class="col" style="margin-bottom: 20px;">
                    <div class="card mx-auto" style="width: 100%; cursor: pointer;" wire:click="redireccionarVistaProductoDetalle({{$item->id}})">
                        <img src="{{asset($item->imagen)}}" class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: {{$item->nombre}}</h5>
                            <p class="card-text">Descripcion: {{$item->descripcion}}</p>
                            <p class="card-text">Precio: S/. {{$item->precio}}</p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Estado: {{$item->estado}}</p>
                                <p class="card-text">Stock: {{$item->stock}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>    
    </div>
</div>
