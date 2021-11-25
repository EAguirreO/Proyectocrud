<div class="d-flex">
    <a href="{{route('product.cart')}}" class="text-white">
      <i class="bi bi-cart" style="font-size: 20px;"></i>
      {{-- <span>Carrito</span> --}}
      @if (Cart::instance('cart')->count() > 0)
        @if (Cart::instance('cart')->count() > 1)
          <span>{{Cart::instance('cart')->count()}} items</span>
        @else
          <span>{{Cart::instance('cart')->count()}} item</span>    
        @endif
      @endif
    </a>
</div>
