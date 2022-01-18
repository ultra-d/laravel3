@csrf
<div class="form-group">
    <label for="name">{{__('form.users.name')}}</label>
    <input class="form-control bg-light shadow-sm
    @error('name') is-invalid @else border-0
    @enderror"
    id="name"
    type="text"
    name="name"
    value="{{ old('name', $user->name) }}"
    placeholder="{{__('form.users.name')}}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="email">{{ __('form.users.email')}}</label>
    <input class="form-control bg-light shadow-sm
    @error('email')
    is-invalid @else border-0
    @enderror"
    id="email"
    type="email"
    name="email"
    placeholder="{{ __('form.users.email')}}" 
    value="{{ old('email', $user->email) }}">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message}}</strong>
    </span>
    @enderror
    <br>
</div>

<div>
    @foreach($roles as $role)
    <div class="form-check">
        <input class="form-check-input border-0.03 shadow" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->name }}" @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
        <label class="form-check-label" for="{{ $role->name }}">
            {{ $role->name }}
        </label>
    </div>
    @endforeach
</div>

<br>
