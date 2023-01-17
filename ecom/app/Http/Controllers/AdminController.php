<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $result = Admin::where(['email'=>$request['email'], 'password'=>$request['password']])->first();
        if($result){
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$result->id);
            return redirect('admin/dashboard');
        }else{
            $request->session()->flash('error','Wrong email or password');
            return redirect('/admin');
        }
    }

    public function dashboard()
    {
        return view('admin.layout');
    }
}
