<?php

namespace App\Http\Controllers;

use App\Models\account;
use Illuminate\Http\Request;


use App\Models\userdata;
use App\Models\UserTable;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;




class AccountController extends Controller
{
    public function register()
    {
        return view('authenticate.register');
    }
    public function login()
    {
        return view('authenticate.login');
    }
    public function home()
    {
        return view('welcome');
    }

    public function loginValidate(Request $data)
    {

        $data->validate([
            'email' => 'required | email',
            'password' => ['required', Password::min(5)->mixedCase()->numbers()]
        ]);

        $credentials = $data->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect(route("login"))->with("error", "Login Failed");
    }


    public function validateRegister(Request $req)
    {
        // dd($req);
        $req->validate([
            'username' => 'required | string|regex:/^[A-Za-z\s]+$/|max:50',
            'email' => 'required | email',
            'password' => ['required', 'confirmed', Password::min(5)->mixedCase()->numbers()],
            'role' => 'required | in:Admin,User'
        ]);


        $users = new account();
        $users->username = $req->username;
        $users->email = $req->email;
        $users->password = Hash::make($req->password);
        $users->role = $req->role;

        if ($users->save()) {
            return redirect(route("login"));
        }
    }


    public function employess()
    {
        $employess = account::get();
        return view('authenticate.view_users', compact('employess'));
    }

    public function adminRegister(Request $req)
    {
        $req->validate([
            'username' => 'required | string|regex:/^[A-Za-z\s]+$/|max:50',
            'email' => 'required | email',
            'password' => ['required', 'confirmed', Password::min(5)->mixedCase()->numbers()],
            'role' => 'required | in:Admin,User'
        ]);


        $users = new account();
        $users->username = $req->username;
        $users->email = $req->email;
        $users->password = Hash::make($req->password);
        $users->role = $req->role;

        if ($users->save()) {
            return redirect(route("employe-Accounts"));
        }
    }

    public function updateUser(Request $request, $id)
    {
        $role = account::findOrFail($id);
        $role->role = $request->input('role');

        if ($role->save()) {
            return back();
        }
    }

    public function deleteuser(Request $req, $id)
    {

        $delete = account::where('id', $id)->first();
        $delete->delete();
        return back()->withSuccess('User removed from Account');
    }
}
