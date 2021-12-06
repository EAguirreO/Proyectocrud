@extends('adminlte::page')

@section('title', 'Detalles de la orden')

@section('content_header')
    <h1>Detalles de la orden</h1>
@stop

@section('content')
    @livewire('admin-product-orders', ['id'=>$id])
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@stop