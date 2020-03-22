<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Hashids\Hashids;

class UserController extends Controller
{
    public function index(User $model)
    {
        $hashids = new Hashids();
        return view('users.index', ['users' => $model->paginate(15),'hash' => $hashids]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request, User $user)
    {
        $data = $request->merge([
            'password' => Hash::make($request->get('password'))
        ])->all();

        $response = $user->create($request->merge([
            'password' => Hash::make($request->get('password'))
        ])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    public function edit($id)
    {
        $hashids = new Hashids();
        $id = $hashids->decodeHex($id);
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User  $user)
    {
        $user->update($request->merge([
                'password' => Hash::make($request->get('password'))
            ])->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    public function destroy(User  $user)
    {
        $user->delete();
        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
