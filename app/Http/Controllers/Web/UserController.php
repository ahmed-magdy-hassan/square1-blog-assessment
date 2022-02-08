<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Web\User\StoreUserRequest;
use App\Http\Requests\Web\User\UpdateUserRequest;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('show-users')) {
            abort(403);
        }
        return view('web.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('create-user')) {
            abort(403);
        }

        return view('web.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Web\User\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if (!Gate::allows('create-user')) {
            abort(403);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();

        $user->save();

        if ($request->hasFile('image')) {
            $user->updateProfilePhoto($request->image);
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Gate::allows('update-user', $user)) {
            abort(403);
        }

        return view('web.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\UpdateUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!Gate::allows('update-user', $user)) {
            abort(403);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->update();

        if ($request->hasFile('image')) {
            $user->updateProfilePhoto($request->image);
        }

        return redirect()->route('users.index');
    }
}
