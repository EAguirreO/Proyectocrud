<div class="d-flex">
    <a href="#" class="text-white">
      <span>Carrito</span>
      @if (Cart::instance('cart')->count() > 0)
        <span>{{Cart::instance('cart')->count()}} items</span>
      @endif
    </a>
</div>
