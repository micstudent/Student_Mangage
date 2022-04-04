<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;

class AdminController extends Controller
{
    public function adminlogin()
    {   
    	return view('adminlogin');
    }

    public function adminloged(Request $req)
    {
        $admin = Admin::where('username',$req->input('username'))->get();
         //return Crypt::decrypt('');
        if(Crypt::decrypt($admin[0]->password)==$req->input('password'))
        {
            $req->session()->put('data',$req->input());
            return redirect('/studentdetails');
        }

        return redirect('/loginpage')->with('fail','Login Fail!');
    }
}
