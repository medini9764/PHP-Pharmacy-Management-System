<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login()
    {
        return view("login");
    }

    public function registration()
    {
        return view("registration");
    }

    public function dashboard()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            return view("dashboard",compact('data'));
        }

    }

    public function adminDashboard()
    {
        $data = array();

        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            return view("admin_dashboard",compact('data'));
        }

    }

    public function logout()
    {

        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/');
        }

    }

    public function registerUser(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'contact_no' => 'required|numeric|min:10',
            'date_of_birth' => 'required|date',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $input = $request->all();
        $input['user_role'] = 1;
        $input['password'] = Hash::make($input['password']);
        $res = User::create($input);

        if($res)
        {
            return back()->with('success','You have registered');
        }else{
            return back()->with('fail','Something wrong');
        }


    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if($user->user_role == 2){
                if(hash::check($request->password,$user->password)){
                    $request->session()->put('loginId',$user->id);
                    return redirect('/dashboard');
                }else{
                    return back()->with('fail','Password is incorrect please check again');
                }
            }elseif($user->user_role == 1){
                if(hash::check($request->password,$user->password)){
                    $request->session()->put('loginId',$user->id);
                    return redirect('/adminDashboard');
                }else{
                    return back()->with('fail','Password is incorrect please check again');
                }
            }
        }else{
            return back()->with('fail','This email is not registered');
        }
    }
}
