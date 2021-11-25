<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    @yield('styles')
    <title>Document</title>
    @livewireStyles
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand align-items-center" href="#">
                <img src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->is('catalogo') ? 'active' : '' }}"
                        href="{{ route('vistaCatalogo') }}">Catálogo</a>
                    {{-- <a class="nav-link {{ (request()->is('cart')) ? 'active' :'' }}" href="{{route('product.cart')}}">Cart</a> --}}
                    {{-- <a class="nav-link {{ (request()->is('checkout')) ? 'active' :'' }}" href="{{route('product.checkout')}}">Checkout</a> --}}
                </div>
            </div>

            @if (Auth::check())
              {{-- <h1 class="text-white">{{auth()->user()->name}}</h1> --}}
              @livewire('user-dropdown')
            @else
              <a class="btn btn-info me-3" href="/login">Log In</a>
            @endif

            @livewire('cart-count-component')
        </div>
    </nav>

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
