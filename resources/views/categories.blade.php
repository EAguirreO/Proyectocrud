@extends('adminlte::page')

@section('title', 'Categoria')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Categoría</h1>
@stop

@section('content')
{{-- @livewire('create-category') --}}
{{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
    <div class="overflow-hidden shadow-xl sm:rounded-lg">
        <livewire:categorias />
        {{-- @push('modals')
            <livewire:live-modal />
        @endpush --}}
    </div>
{{-- </div> --}}
@stop


@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script>
        Livewire.on('alert', function(message){
            Swal.fire(
                'Éxito',
                message,
                'success'
            )
        })
    </script>
@stop