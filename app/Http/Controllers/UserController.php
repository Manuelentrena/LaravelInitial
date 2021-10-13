<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

  public function index()
  {
    $users = User::latest()->get();

    return view('users.index', ['users' => $users]);
  }

  public function store(Request $request)
  {

    $request->validate([
      'name' => 'required',
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'min:3'],
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return back();
  }

  public function destroy($id)
  {
    User::find($id)->delete();
    return back();
  }
}
