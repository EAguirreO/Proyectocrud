@section('styles')
<link href="{{asset('css/cart-vista.css')}}" rel="stylesheet">
@endsection
<div>
    <div class="container">
        @if (Session::has('success_message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success_message')}}
            </div>
        @endif
        <h4 class="mt-4">Productos agregados al carrito</h4>
        @if (Cart::instance('cart')->count()>0)
            @foreach (Cart::instance('cart')->content() as $item)
                
                <div class="alert alert-secondary" role="alert">
                    <table class="table table-borderless">
                        <tr valign="middle">
                            <td>
                                <img src="{{asset($item->model->imagen)}}" width="100" height="100" alt="{{$item->model->nombre}}">
                            </td>
                            <td>
                                <h5 class="asd">{{$item->model->nombre}}</h5>
                            </td>
                            <td>
                                <h5>S/.{{$item->model->precio}}</h5>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button style="width: 37px; height: 37px; border: 1px solid #c6c6c6; border-radius: 5px; display: flex; align-items: center; justify-content: center; " wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">-</button>
                                    <input style="width: 60px;" type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >
                                    <button style="width: 37px; height: 37px; border: 1px solid #c6c6c6; border-radius: 5px; display: flex; align-items: center; justify-content: center; " wire:click.prevent="increaseQuantity('{{$item->rowId}}')">+</button>
                                </div>
                            </td>
                            <td>
                                <h5>S/.{{$item->subtotal}}</h5>
                            </td>
                            <td>
                                <button class="btn btn-danger" wire:click.prevent="destroy('{{$item->rowId}}')">X</button>
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
            <div class="d-flex justify-content-end">
                <button class="btn btn-danger">Limpiar carrito</button>
            </div>
        @else
            <p>No hay productos en el carrito</p>
        @endif

        <h4>Resumen del pedido</h4>

        <div>
            <div class="d-flex justify-content-between">
                <h5>Subtotal</h5>
                <h5>S/.{{Cart::instance('cart')->subtotal()}}</h5>
            </div>
            {{-- <div class="d-flex justify-content-between">
                <h5>Impuesto</h5>
                <h5>S/.{{Cart::tax()}}</h5>
            </div> --}}
            {{-- <div class="d-flex justify-content-between">
                <h5>Envío</h5>
                <h5>Gratis</h5>
            </div> --}}
            {{-- <div class="d-flex justify-content-between">
                <h5>Total</h5>
                <h5>S/.{{Cart::total()}}</h5>
            </div> --}}
        </div>
    </div>
</div>
