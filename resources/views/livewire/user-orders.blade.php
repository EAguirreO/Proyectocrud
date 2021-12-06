<div>
    {{-- <h1>El id del usuario es: {{auth()->user()->id}}</h1> --}}
    {{-- <h1>Id de la orden es: {{$idOrden}}</h1> --}}
    <table id="example" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Código de la compra</th>
                <th>Monto total</th>
                <th>Fecha</th>
                {{-- <th>Detalles</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $item) 
                <tr wire:click="actualizarId({{$item->id}})" style="cursor: pointer;">
                    <td>{{$item->codigo_compra}}</td>
                    <td>{{$item->monto_total}}</td>
                    <td>{{$item->fecha_compra}}</td>
                    {{-- <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click.prevent="actualizarId({{$item->id}})">Ver detalles</button></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($ordenes->hasPages())
    <div class="d-flex justify-content-center">
        {{ $ordenes->links() }}
    </div>
    @endif

    {{-- <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('modal-detalle-orden', ['idOrden' => $idOrden])
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div> --}}
</div>

