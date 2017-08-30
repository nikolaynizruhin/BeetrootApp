<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Office;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['client', 'office'])->get();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'birthday' => $request->birthday,
            'bio' => $request->bio,
            'slack' => $request->slack,
            'skype' => $request->skype,
            'github' => $request->github,
            'client_id' => $request->client_id,
            'office_id' => $request->office_id,
            'password' => $request->password,
            'avatar' => $request->file('avatar')->store('avatars'),
            'remember_token' => str_random(10),
            'is_admin' => (bool) $request->is_admin
        ]);

        return back()->with('status', 'The user was successfully created!');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $user->updateFromRequest($request);

        return back()->with('status', 'The user was successfully updated!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.create')->with('status', 'The user was successfully deleted!');
    }
}
