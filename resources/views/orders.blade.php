@extends('adminlte::page')

@section('title', 'Órdenes')

@section('content_header')
    <h1>Órdenes</h1>
@stop

@section('content')
@livewire('admin-orders')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop