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

    <div class="d-flex justify-content-center align-items-center mb-4" style="background-image: url({{asset('img/catalogo/slide.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center;height: 300px;">
        <h2 class="text-white fw-bold" style="text-align: center; font-weight: lighter; font-size: 3.5rem;">CATÁLOGO</h2> 
    </div>

    <div class="d-flex mb-5">

        <div class="col-sm-3 me-4">
            <label class="fw-bold" style="font-size: 1.8rem">Categorias</label>
            <select wire:model="selectedCategory" class="form-select">
                <option value="">Categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
        </div>
    
        @if (!is_null($subcategorias))    
            <div class="col-sm-3">
                <label class="fw-bold" style="font-size: 1.8rem">Subcategorias</label>
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
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" >
            @foreach ($productos as $item)
                <div class="col" style="margin-bottom: 20px;">
                    <div class="card mx-auto" style="width: 100%; cursor: pointer;" wire:click="redireccionarVistaProductoDetalle({{$item->id}})">
                        <img src="{{asset($item->imagen)}}" class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: {{$item->nombre}}</h5>
                            <p class="card-text">Descripcion: {{$item->descripcion}}</p>
                            <p class="card-text">Precio: {{$item->precio}}</p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text">Estado: {{$item->estado}}</p>
                                <p class="card-text">Stock: {{$item->stock}}</p>
                            </div>
                            <a class="btn btn-danger" href="#" wire:click.prevent="store({{$item->id}}, '{{$item->nombre}}',{{$item->precio}})">Agregar al carrito</a>
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
        <div>
            {{-- <h2>Productos</h2>
                <p>Categoria {{$selectedCategory}}- Subcategoria {{$selectedSubcategory}}</p> --}}
            <div wire:loading wire:loading.target="productos" class="mx-auto">
                <div class="spinner-border text-primary" role="status">
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
                                    <div class="card mx-auto" style="width: 100%; cursor: pointer;" wire:click="redireccionarVistaProductoDetalle({{$producto->id}})">
                                        <img src="{{asset($producto->imagen)}}" class="card-img-top img-fluid" style="width: 100%; height: 15vw; object-fit: cover;" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">Nombre: {{$producto->nombre}}</h5>
                                            <p class="card-text">Descripcion: {{$producto->descripcion}}</p>
                                            <p class="card-text">Estado: {{$producto->estado}}</p>
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
