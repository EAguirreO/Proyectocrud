@section('styles')
<link href="{{asset('css/cart-vista.css')}}" rel="stylesheet">
@endsection
<div>
    @php
        // dd(Cart::instance('cart')->content());
        // if(Cart::instance('cart')->count() > 0){
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia

        foreach (Cart::instance('cart')->content() as $product) {
            # code...
            // echo $product;
            $item = new MercadoPago\Item();
            $item->title = $product->model->nombre;
            $item->id = $product->model->id;
            $item->quantity = $product->qty;
            $item->unit_price = $product->model->precio;

            $products[] = $item;
        }

        if(!empty($products)){

            $preference->back_urls = array(
                "success" => route('orders.pay'),
                "failure" => "http://www.tu-sitio/failure",
                "pending" => "http://www.tu-sitio/pending"
            );
            $preference->auto_return = "approved";

            $preference->items = $products;
            $preference->save();
        }
        // }
    @endphp
    <div class="container">
        @if (Session::has('success_message'))
            <div class="alert alert-success mt-2" role="alert">
                {{Session::get('success_message')}}
            </div>
        @endif
        <h4 class="mt-4">Productos agregados al carrito</h4>
        @if (Cart::instance('cart')->count()>0)
            <table  id="carrito" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre del producto</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                        {{-- <th>Detalles</th> --}}
                    </tr>
                </thead>
                
                <tbody>
                    @foreach (Cart::instance('cart')->content() as $item)
                        <tr valign="middle">
                            <td>
                                <img src="{{asset($item->model->imagen)}}" width="100" height="100" alt="{{$item->model->nombre}}">
                            </td>
                            <td>
                                <h5 class="asd">{{$item->model->nombre}}</h5>
                            </td>
                            <td>
                                <h5>S/. {{$item->model->precio}}</h5>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button style="width: 37px; height: 37px; border: 1px solid #c6c6c6; border-radius: 5px; display: flex; align-items: center; justify-content: center; " wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">-</button>
                                    <input style="width: 60px;" type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" disabled>
                                    <button style="width: 37px; height: 37px; border: 1px solid #c6c6c6; border-radius: 5px; display: flex; align-items: center; justify-content: center; " wire:click.prevent="increaseQuantity('{{$item->rowId}}')">+</button>
                                </div>
                            </td>
                            <td>
                                <h5>S/. {{$item->subtotal}}</h5>
                            </td>
                            <td>
                                <button class="btn btn-danger" wire:click.prevent="destroy('{{$item->rowId}}')">X</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between mb-4">
                <button class="btn btn-danger" wire:click.prevent="destroyAll()">Limpiar carrito</button>
                @auth
                {{-- @if (Auth::check()) --}}
                <div class="cho-container">
                    
                </div>

                <a class="btn btn-primary" href="{{route('create.order')}}">Continuar</a>
                    
                @endauth
                {{-- @else --}}
                @guest
                    
                <a href="/login" class="btn btn-info text-white" style="background-color: #009ee3">Pagar</a>
                {{-- @endif --}}
                @endguest
            </div>
        @else
            <h5 class="text-danger">No hay productos en el carrito</h5>
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

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    @if(!empty($products))
    
    <script>
        // window.addEventListener('contentChanged', event => {
        // console.log('asd');
        // // if($products){
        // // Agrega credenciales de SDK
        //   const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
        //         locale: 'es-PE'
        //   });
        
        // // if(!isset($preference)){
        //   // Inicializa el checkout
        //   mp.checkout({
        //       preference: {
        //           id: '{{ $preference->id }}'
        //       },
        //       render: {
        //             container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
        //             label: 'Pagar', // Cambia el texto del botón de pago (opcional)
        //       }
        //     });
        // // }
        // // }
        // });

        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-PE'
          });

        mp.checkout({
              preference: {
                  id: '{{ $preference->id }}'
              },
              render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Pagar', // Cambia el texto del botón de pago (opcional)
              }
            });

        window.addEventListener('contentChanged', event => {
            const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-PE'
            });

            mp.checkout({
              preference: {
                  id: '{{ $preference->id }}'
              },
              render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Pagar', // Cambia el texto del botón de pago (opcional)
              }
            });
        });


    </script>
    @endif
</div>
