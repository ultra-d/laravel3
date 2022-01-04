@csrf

{{ __('form.users.name')}}
<br>
<label>
    <input name="name" placeholder="{{ __('form.users.name') }}" type="text" value="{{old('name')}} 
    @isset($user){{$user->name}}@endisset">
    @error('name')
    <div>
        {{ $message }}
    </div>
    @enderror
</label>
<br>

{{ __('form.users.email') }}
<br>
<label>
    <input name="email" placeholder="{{ __('form.users.email') }}" type="email" value="{{ old('email') }} 
    @isset($user) {{ $user->email }} @endisset">
    @error('email')
    <div>
        {{ $message }}
    </div>
    @enderror
</label>
@isset($create)
<br>
{{ __('form.users.password') }}
<br>
<label>
    <input name="password" placeholder="{{ __('form.users.password') }}" type="password">
    @error('password')
    <div>
        {{ $message }}
    </div>
    @enderror
</label>
@endisset
<div>
    @foreach($roles as $role)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->name }}" @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
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
    <input type="checkbox" id="disable" name="disable" {{ $user->isDisabled() ? 'checked' : '' }}>
    <label for="disable"> {{ __('form.users.disable') }}</label><br>
</div>
@endisset
<input type="submit" value="Register">