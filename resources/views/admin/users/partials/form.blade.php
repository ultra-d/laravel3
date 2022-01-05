@csrf
<div class="form-group">
    <label for="name">{{__('form.users.name')}}</label>
    <input class="form-control bg-light shadow-sm
    @error('name') is-invalid @else border-0
    @enderror"
    id="name"
    type="text"
    name="name"
    value="{{ old('name') }}@isset($user){{$user->name}}@endisset"
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
    value="{{ old('email') }} @isset($user) {{ $user->email }} @endisset">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message}}</strong>
    </span>
    @enderror
    <br>
</div>

@isset($create)
<div class="form-group">
    <label for="password">{{ __('form.users.password')}}</label>
    <input class="form-control bg-light shadow-sm
    @error('password')
    is-invalid @else border-0
    @enderror"
    id="password" 
    type="password" 
    name="password" 
    placeholder="{{ __('form.users.password')}}" 
    value="{{ old('password') }}">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message}}</strong>
    </span>
    @enderror
    <br>
</div>
@endisset

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

@isset($edit)
<strong>{{ __('form.users.status') }}</strong>
<div>
    <input class="form-check-input border-0.03 shadow" type="checkbox" id="disable" name="disable" {{ $user->isDisabled() ? 'checked' : '' }}>
    <label class="form-check-label" for="disable"> {{ __('form.users.disable') }}</label>
    <br>
</div>

@endisset
<br>
<button class="btn btn-primary btn-lg btn-block">
    {{ __('form.button.save')}}
</button>