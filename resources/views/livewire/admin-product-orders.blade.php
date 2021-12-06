<div>
    <a href="{{route('admin.orders')}}" class="btn btn-outline-dark my-4 ms-2"><i class="bi bi-arrow-left me-3"></i>Regresar</a>
    {{-- asdasd {{$id_Orden}} --}}
    <div wire:loading.delay>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <table wire:loading.remove id="example" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Imagen</th>
                {{-- <th>Detalles</th> --}}
            </tr>
        </thead>
        
        <tbody>
            
            @foreach ($product_orders as $item) 
                <tr>
                    <td>{{$producto::find($item->id_producto)->nombre}}</td>
                    {{-- <td>{{$producto::where('id',$item->id_producto)->get()[0]->nombre}}</td> --}}
                    <td>S/. {{$item->precio}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>S/. {{$item->subtotal}}</td>
                    <td><img height="80" src="{{asset($producto::find($item->id_producto)->imagen)}}" alt=""></td>
                    {{-- <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click.prevent="actualizarId({{$item->id}})">Ver detalles</button></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <div wire:loading.remove>
        @if ($product_orders->hasPages())
            <div class="d-flex justify-content-center">
                {{ $product_orders->links() }}
            </div>
        @endif 
    </div>
    
</div>