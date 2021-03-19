<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	$data = DB::table('users')
    	->where('name', '!=', Auth::user()->name)
    	->get();
    	// dd($data);
    	return view('user.account', compact('data'));
    }

    public function create()
    {
    	return view('user.add-account');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'username' => 'required|unique:users',
    		'nama' => 'required',
    		'password' => 'required'
    	],[
            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.unique' => 'Username Sudah Terpakai!, Harap Coba Yang Lain',
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong'
        ]
    );

    	$data = new User;

    	$data->name = $request->nama;
    	$data->username = strtolower($request->username);
    	$data->password = Hash::make($request->password);
    	$data->role = 2;

    	$data->save();

    	return redirect('account')->with('success', 'Akun Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('user.edit-account', compact('data'));
    }

    public function ubah()
    {
        $data = User::find(Auth::user()->id);
        return view('user.edit-account', compact('data'));
    }

    public function input(Request $request)
    {
        $data = User::find(Auth::user()->id);
        if($request->username == $data->username)
        {
           $request->validate([
            'nama' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
        ]);
           $data->name = $request->nama;
       }else{
        $request->validate([
            'username' => 'required|unique:users',
            'nama' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.unique' => 'Username Sudah Terpakai! Harap Coba Yang Lain'
        ]);
        $data->name = $request->nama;
        $data->username = strtolower($request->username);
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        if($request->username == $data->username)
        {
           $request->validate([
            'nama' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
        ]);
           $data->name = $request->nama;
       }else{
        $request->validate([
            'username' => 'required|unique:users',
            'nama' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.unique' => 'Username Sudah Terpakai! Harap Coba Yang Lain'
        ]);
        $data->name = $request->nama;
        $data->username = strtolower($request->username);
    }

    $data->save();

    return redirect('account')->with('success', 'Akun Berhasil Diedit!');
}

public function destroy($id)
{
    User::destroy($id);
    return redirect('account')->with('danger', 'Akun Telah Terhapus!');
}

public function changePass()
{
    $data = Auth::user()->id;
    return view('user.change-password', compact('data'));
}

public function updatePass(Request $request)
{

    $user = auth()->user();

    $validated = $request->validate([
        'old_password' => [
            'required',

            function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password Lama Salah!');
                }
            }
        ],
        'password' => 'required|different:old_password'
    ],[
        'password.required' => 'Masukkan Password Baru',
        'old_password.required' => 'Masukkan Password Lama'
    ]);

    $user->fill([
        'password' => Hash::make($validated['password'])
    ])->save();

    return redirect('change-password')->with('success', 'Password Berhasil Diubah');

}
}
