@extends('layout')

@section('title', 'Portafolio')

@section('content')
	<h1>Portafolio</h1>
	<a href="{{ route('projects.create') }}">Crear proyecto</a>
	<ul>

		@forelse($projects as $project)
			<li><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a><br></li>
		@empty
			<li>No hay proyectos para mostrar</li>
		@endforelse
		{{ $projects->links() }}
	</ul>
@endsection