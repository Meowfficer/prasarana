<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function register()
  {
    return view('auth.register');
  }

  public function index()
  {
    if (Auth::check()) {
     return abort(404);
   } else {
     return view('auth.login');
   }
 }

 public function login(Request $request)
 {
  $request->validate([
    'username' => 'required',
    'password' => 'required'
  ],[
    'username.required' => 'Harap Masukkan Username!',
    'password.required' => 'Harap Masukkan Password!'
  ]);

  $username = $request->username;
  $password = $request->password;

  $data = User::where('username', $username)->first();
   // if ($data == null) {
   //    return redirect('login')->with('warning', 'Username Tidak Terdaftar!');
   // }
  if ($data) {
    $credentials = $request->only('username', 'password');
    if (Auth::attempt($credentials)) {
     return redirect('/');
   }else{
    return redirect('login')->with('warning', 'Password Salah!');
  }
} else {
  return redirect('login')->with('warning', 'Username Salah!');
}

}

public function store(Request $request)
{
 $data = new User();
 $data->name = $request->nama;
 $data->username = $request->username;
 $data->password = Hash::make($request->password);
 $data->role = 1;
 $data->save();
 return redirect('login');
}

public function logout()
{
    	Auth::logout(); // menghapus session yang aktif
      return redirect('login');
    }
  }
