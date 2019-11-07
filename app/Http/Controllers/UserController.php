<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getUsers(){
        $users=User::get();
        $roles=Role::get();
        return view('users.all')->with(['roles'=>$roles,'users'=>$users]);
    }

    public function postAssignUserRole(Request $request){
        $user_id=$request['user_id'];
        $role=$request['role'];
        $user=User::whereId($user_id)->firstOrFail();
        $user->syncRoles($role);

        return redirect()->back()->with('info','The selected user role has been changed.');
    }

    public function getDeleteUser($id){
        $user=User::whereId($id)->firstOrFail();
        $user->delete();

        return redirect()->route('users')->with('info','The selected user has been deleted permanently.');
    }

    public function postUpdateUser(Request $request){
        $id=$request['user_id'];
        $user=User::whereId($id)->firstOrFail();

        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->update();

        return redirect()->route('users')->with('info','The selected user has been changed.');
    }
}
