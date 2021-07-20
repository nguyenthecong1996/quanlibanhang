<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
    	return view('auth.login');
    }

    public function getLogin(Request $request){
        $arr = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
        ];
        if (\Auth::attempt($arr)){
            return redirect('admin/dashboard');
        } else {
            return Redirect::to('/login')->with('message', 'Mật khẩu hoặc tài khoản không chính xác');
        }
    }

    public function getRegister(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
        $data = $request->all();
        $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
          'password' => 'required',
          'repeat_password' => 'required'
        ]);
        $name = $data['first_name']. " ". $data['last_name'];
        if ($data['password'] !=  $data['repeat_password']) {
             return Redirect::to('/register')->with('message', 'mật khẩu không khớp');
        }
         $password = bcrypt($data['password']);
        User::create([
            'name' => $name,
            'email' => strtolower($data['email']),
            'password' => $password,
            'phone' => '',
        ]);

        return Redirect::to('/login')->with('message','đăng kí thành công');
    }

    public function logOut(){
    	\Auth::logout();
        return redirect('/login');
    }
}
