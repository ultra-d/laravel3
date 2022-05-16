<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', ['users' => User::paginate(10)]);
    }

    public function create(): View
    {
        return view('admin.users.create', ['roles' => Role::all(), 'user' => new User()]);
    }

    public function store(UpdateUserRequest $request): RedirectResponse
    {
        $user = User::create($request->only(['name', 'email', 'password']));

        $user->roles()->sync($request->roles);

        Log::channel('custom')->info('User Created by' . auth()->user());

        return redirect(route('admin.users.index'))->with('status', 'Usuario creado');
    }

    public function edit($id): View
    {
        return view('admin.users.edit', [
            'roles' => Role::all(),
            'user' => User::find($id),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->has('disable') ? 0 : 1;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect(route('admin.users.index'));
    }

    public function destroy(User $user): RedirectResponse
    {
        User::destroy($user);

        Log::channel('custom')->info('User Deleted by' . auth()->user());

        return redirect(route('admin.users.index'))->with('status', 'Usuario Eliminado');
    }
}
