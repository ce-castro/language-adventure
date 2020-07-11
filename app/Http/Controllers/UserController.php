<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    public function index(){
        $users = User::orderBy('name', 'asc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        $listroles = Role::orderBy('role', 'asc')->get();
        return view('admin.users.create', compact('listroles'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'role_id' => 'required|numeric',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $input = $request->except(['status']);

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        User::create($input);
        session()->flash('message_green', 'User successfully added!');
        return redirect(route('users.index'));
    }


    public function edit(User $user){
        $listroles = Role::orderBy('role', 'asc')->get();
        return view('admin.users.edit', compact('user', 'listroles'));
    }

    public function update($id, Request $request){
        $user = User::findOrFail($id);

        $this->validate($request, [
            'role_id' => 'required|numeric',
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed'
        ]);

        $input = $request->except(['email', 'password', 'status']);

        if($request->has('password')){
            $input['password'] = $request->password;
        }

        if($request->status == 1){
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $user->fill($input)->save();

        session()->flash('message_green', 'User successfully updated!');
        return redirect(route('users.index'));
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message_red', 'User Deleted');
        return redirect(route('users.index'));
    }


}
