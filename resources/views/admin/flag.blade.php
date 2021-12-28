@extends('layout')

@section('title', 'Admin')

@section('content')
	<h1>Prueba admin</h1>
	<p>ERES ADMIN</p>
    @foreach($users as $user)
        {{$user->name}}
    @endforeach
@endsection