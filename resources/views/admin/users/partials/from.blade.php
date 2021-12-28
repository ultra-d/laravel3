@csrf
        Name
    <br>
        <label>
            <input name="name" placeholder= "Nombre..." type="text" value="{{old('name')}} 
            @isset($user) {{ $user->name }} @endisset">
                @error('name')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </input>
        </label>
        <br>
            Email
            <br>
                <label>
                    <input name="email" placeholder="Email..." type="email" value="{{ old('email') }} 
                    @isset($user) {{ $user->email }} @endisset">
                        @error('email')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </input>
                </label>
                @isset($create)
                <br>
                    Password
                    <br>
                        <label>
                            <input name="password" placeholder="Password..." type="password">
                                @error('password')
                                <div>
                                    {{ $message }}
                                </div>
                                @enderror
                            </input>
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
                        <input type="submit" value="Register">
                        </input>
                        </br>
                    </br>
                </br>
            </br>
        </br>
    </br>