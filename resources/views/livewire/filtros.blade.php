<div>
    {{-- <div class="container-fluid mb-5">
        <label>Categorías</label>
        <select wire:model="categoryId" wire:change="filterSubcategoryByCategoryId">
            @foreach ($category->all(['id', 'nombre']) as $category)
                <option value="{{$category->id}}">{{$category->nombre}}</option>
            @endforeach
        </select>
    </div>

    @if($subcategories)
        <div class="container-fluid mb-5">
            <label>Subcategorias</label>
            <select>
                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->nombre}}</option>
                @endforeach
            </select>
        </div>
    @endif --}}

    {{-- <div class="d-flex justify-content-center align-items-center mb-4" style="background-image: url({{asset('img/catalogo/slide.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center;height: 300px;">
        <h2 class="text-white fw-bold" style="text-align: center; font-weight: lighter; font-size: 3.5rem;">CATÁLOGO</h2> 
    </div> --}}
    <div class="d-flex justify-content-center align-items-center mb-4" style="background-color:slategrey; height: 300px;">
        <h2 class="text-white fw-bold" style="text-align: center; font-weight: lighter; font-size: 3.5rem;">CATÁLOGO</h2> 
    </div>

    <div class="d-flex">

        <div class="d-flex flex-column mb-5 mx-2" style="width: 20%">
    
            <div class="mb-4"> <!--class="col-sm-3 me-4"-->
                <label class="fw-bold" style="font-size: 1.5rem">Categorias</label>
                <select wire:model="selectedCategory" class="form-select">
                    <option value="">Categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
        
            @if (!is_null($subcategorias))    
                <div> <!-- class="col-sm-3" -->
                    <label class="fw-bold" style="font-size: 1.5rem">Subcategorias</label>
                    <select wire:model="selectedSubcategory" class="form-select">
                        <option value="">Subcategoría</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{$subcategoria->id}}">{{$subcategoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            @endif

        </div>

        @if (is_null($selectedCategory))
            <div class="container-fluid" style="width: 80%">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" >
                    @foreach ($productos as $item)
                        <div class="col" style="margin-bottom: 20px;">
                            <div class="card mx-auto" style="width: 100%; height: 100%"">
                                <img wire:click="redireccionarVistaProductoDetalle({{$item->id}})" src="{{asset($item->imagen)}}" class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover; cursor: pointer;" alt="">
                                <div class="card-body">
                                    <div style="cursor: pointer;" wire:click="redireccionarVistaProductoDetalle({{$item->id}})">
                                        <h5 class="card-title fw-bold fs-4">{{$item->nombre}}</h5>
                                        <p class="card-text">Descripcion: {{$item->descripcion}}</p>
                                        <p class="card-text fw-bold fs-5">Precio: S/. {{$item->precio}}</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="card-text">Estado: {{$item->estado}}</p>
                                            <p class="card-text">Stock: {{$item->stock}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a style="width: 100%" class="btn btn-danger" href="#" wire:click.prevent="store({{$item->id}}, '{{$item->nombre}}',{{$item->precio}})">Agregar al carrito <i class="bi bi-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>    
                @if ($productos->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $productos->links() }}
                </div>
                @endif
            </div>
        @else
            <div style="width: 80%">
                {{-- <h2>Productos</h2>
                    <p>Categoria {{$selectedCategory}}- Subcategoria {{$selectedSubcategory}}</p> --}}
                <div wire:loading wire:loading.target="productos">
                    <div class="spinner-border text-primary mx-auto" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div wire:loading.remove class="container-fluid">
                    @if (!($selectedSubcategory == ''))
                        @if ($productos->isEmpty())
                            <h5 class="text-danger">¡No existen productos en esta subcategoría!</h5>
                        @else
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                                @foreach ($productos as $producto)
                                    <div class="col" style="margin-bottom: 20px;">
                                        <div class="card mx-auto" style="width: 100%; height: 100%" >
                                            <img wire:click="redireccionarVistaProductoDetalle({{$producto->id}})" src="{{asset($producto->imagen)}}" class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover; cursor: pointer;" alt="">
                                            <div class="card-body">
                                                {{-- <h5 class="card-title">Nombre: {{$producto->nombre}}</h5>
                                                <p class="card-text">Descripcion: {{$producto->descripcion}}</p>
                                                <p class="card-text">Estado: {{$producto->estado}}</p> --}}
                                                <div style="cursor: pointer;" wire:click="redireccionarVistaProductoDetalle({{$producto->id}})">
                                                    <h5 class="card-title fw-bold fs-4">{{$producto->nombre}}</h5>
                                                    <p class="card-text">Descripcion: {{$producto->descripcion}}</p>
                                                    <p class="card-text fw-bold fs-5">Precio: S/. {{$producto->precio}}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="card-text">Estado: {{$producto->estado}}</p>
                                                        <p class="card-text">Stock: {{$producto->stock}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <a style="width: 100%" class="btn btn-danger" href="#" wire:click.prevent="store({{$producto->id}}, '{{$producto->nombre}}',{{$producto->precio}})">Agregar al carrito <i class="bi bi-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($productos->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $productos->links() }}
                            </div>
                            @endif
                        @endif
                    @else
                        
                        <h5 class="text-danger">¡Seleccione la subcategoría!</h5>
                    @endif
                </div>
            </div>
        @endif

    </div>

    <div>
        <select wire:model="selectedDepartamento" class="form-select">
            <option value="" selected>Departamento</option>
            @foreach ($departamentos as $departamento)
                <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
            @endforeach
        </select>
        @if (!is_null($selectedDepartamento))
        <select wire:model="selectedProvincia" class="form-select">
            <option value="" selected>Provincia</option>
            @foreach ($provincias as $provincia)
                <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
            @endforeach
        </select>
        @endif
        @if(!is_null($selectedProvincia))
        <select wire:model="selectedDistrito" class="form-select">
            <option value="" selected>Distrito</option>
            @foreach ($distritos as $distrito)
                <option value="{{$distrito->id}}">{{$distrito->nombre}}</option>
            @endforeach
        </select>
        @endif
    </div>

</div>
