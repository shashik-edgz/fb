<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;



class UserController extends Controller
{

     public function postSignUp(Request $request)
     {
         $this->validate($request,[
            'email' =>'required|email|unique:users',
             'first_name' => 'required|max:120',
             'password'=> 'required|min:4'
         ]);

         $email =$request['email'];
         $first_name =$request['first_name'];
         $password =bcrypt($request['password']);

         $user = new User();
         $user->email=$email;
         $user->first_name = $first_name;
         $user->password = $password;
         $user->role='0';

         $user->save();

         Auth::login($user);

         return redirect()->route('dashboard');
     }

     public function postSignIn(Request $request)
     {
         $this->validate($request,[
             'email' =>'required',
             'password'=> 'required'
         ]);

         if(Auth::attempt(['email' => $request['email'],'password' => $request['password']]))
         {
             return redirect()->route('dashboard');
         }
         return redirect()->back();


     }
     public function getLogout()
     {
         Auth::logout();
         return redirect()->route('home');
     }
     public function getAccount()
     {
         return view('account',['user'=>Auth::user()]);
     }

     public function postSaveAccount(Request $request)
     {
         $this->validate($request,[
            'first_name'=>'required|max:120'
         ]);

         $user = Auth::user();
         $user->first_name = $request['first_name'];
         $user->update();
         $file = $request->file('image');
         $filename ='img'.$user->id.'.jpg';
         if ($file){
             Storage::disk('local')->put($filename,File::get($file));
         }else
         {

         }

         return redirect()->route('account');
     }

     public function getUserImage($filename)
     {
         $file = Storage::disk('local')->get($filename);
         return new Response($file, 200);
     }

     public function adminPanel()
     {
         if(!Auth::user()->role){
            return redirect()->back();
         }
         $users = User::orderBy('created_at','asc')->get();

         return view('admin', ['users' => $users]);

     }

     public function myAccount()
     {
         $user = Auth::user();
         $posts =Auth::user()->posts()->get();
         return view('myacc',['user'=>$user,'posts'=>$posts]);

     }

}