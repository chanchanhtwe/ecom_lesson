<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
       $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::User()->hasAnyRole(['Member'])){
            $orders=Order::where('user_id',Auth::id())->get();
            return view('home')->with(['orders'=>$orders]);
        }elseif (Auth::User()->hasAnyRole(['Admin'])){
            $orders=Order::get();
            $posts=Post::get();
            $cats=Category::get();
            $users=User::get();
            return view('home')
                ->with(['orders'=>$orders,
                    'posts'=>$posts,
                    'cats'=>$cats,
                    'users'=>$users]);
        }else{
            return redirect()->route('/');
        }

    }
}
