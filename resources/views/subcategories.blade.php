@extends('adminlte::page')

@section('title', 'Subcategoria')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Subcategoría</h1>
@stop

@section('content')
@livewire('create-subcategory')
<div class="overflow-hidden shadow-xl sm:rounded-lg">
    <livewire:subcategorias />
</div>
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