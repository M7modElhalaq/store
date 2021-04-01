<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        $imageName = time().'.'.$request->profile_image->extension();
        $request->profile_image->move(public_path('images/users'), $imageName);
        $data['profile_image'] = $imageName;

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        if($user) {
            return redirect(route('users.index'))->with('success', 'User Created Successfully.');
        } else {
            return redirect()->back()->with('error', 'Error in create the user.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        if($user) {
            return view('admin.users.edit')->with([
                'user' => $user,
                'roles' => $roles
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'error' => 'User not found.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if(isset($request->profile_image)) {
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images/users'), $imageName);
            $data['profile_image'] = $imageName;
        }

        if($request->has('password')) {
            if($request->password === $request->password_confirmation) {
                $data['password'] = bcrypt($request->password);
            } else {
                return back()->with('error', 'The password confirmation does not match.');
            }
        }

        $user->update($data);

        if($user) {
            return redirect(route('users.index'))->with('success', 'User Updated Successfully.');
        } else {
            return redirect()->back()->with('error', 'Error in uodate the user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'User Deleted Successfully.');
    }
}
