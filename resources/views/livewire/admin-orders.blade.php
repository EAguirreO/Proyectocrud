<div>
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
</div>
