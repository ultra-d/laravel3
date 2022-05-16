@extends('layout')

@section('title', 'User management')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-11 mx-auto"> 	
			<div class="card">
				<div class="d-flex flex-column justify-content-between align-right ">
					<h1 class="display-6"> {{ __('titles.Admin_panel')}}
						<a class="btn btn-primary btn-sm btn-success" href="{{ route('admin.users.create') }}" role="button">{{ __('messages.users.create')}}</a>
					</h1>
				</div>
			
				<table class="table">
				<thead>
					<tr>
					<th scope="col">#ID</th>
					<th scope="col">{{ __('form.users.name')}}</th>
					<th scope="col">{{ __('form.users.email')}}</th>
					<th scope="col">{{ __('form.users.status')}}</th>
					<th scope="col" colspan="2">{{ __('form.users.actions')}}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>@if( $user->status == 1) {{ 'Enabled' }} @else {{ 'Disabled' }} @endif</td>
					<td>
						<a class="btn btn-sm btn-primary" 
						href="{{ route('admin.users.edit', $user->id) }}" 
						role="button">{{ __('form.button.edit')}}</a>

						<button 
						type="button" 
						class="btn btn-sm btn-danger" 
						onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit()">
						{{ __('form.button.delete')}}
						</button>

						<form id="delete-user-form-{{ $user->id }}" 
						action="{{ route('admin.users.destroy', $user->id) }}" 
						method="POST" 
						style="display: none">
						@method("DELETE")
						@csrf
						</form>
					</td>
					</tr>
				@endforeach
				</tbody>
				</table>
				{{ $users->links() }}

			</div>
		</div>
	</div>
</div>
@endsection
