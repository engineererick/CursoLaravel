@extends('layouts.app')

@section('content')
	<h1>{{$product->title}} ({{$product->id}})</h1>
	<p>{{$product->description}}</p>
	<p>Precio: ${{$product->price}}</p>
	<p>Cantidad: {{$product->stock}}</p>
	<p>Disponibilidad: {{$product->status}}</p>
	<br />
	<p>{{-- $html --}}</p>
	<!--@{{ $var }}-->
@endsection