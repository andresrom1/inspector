<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserCreateController extends Controller
{
    //
    public function create()
    {
        return view('/usuarios.create');
    }

    public function store(Request $request)
    {
        
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'type'=> 'required',
        ]);

        $user = new User();

        $user -> name = request('name');
        $user -> email = request('email');
        $user -> type = request('type');

        $user->save();

        return redirect('/');
       
    }
    public function index()
    {
        $usuarios = User::all();
        return view('/usuarios.index', compact('usuarios'));
    }

    public function destroy(User $user)
    {
        
        $user->delete();

        // $usr = User::findOrFail($user);
        // $usr->delete();

        return redirect()->back()->with('destroy','Datos Eliminados');

    }
}
