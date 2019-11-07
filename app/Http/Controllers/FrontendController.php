<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Order;
use App\Orderitem;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function getWelcome(){
        $cats=Category::get();
        $posts=Post::OrderBy('id','desc')->paginate("6");
        return view('welcome')->with(['cats'=>$cats,'posts'=>$posts]);
    }

    public function getImage($file_name){
        $file=Storage::disk('posts')->get($file_name);
        return response($file)->header('Content-type',"*.*");
    }

    public function getPostsByCategory($cat_id){
        $cats=Category::get();
        $posts=Post::where('category_id',$cat_id)->OrderBy('id','desc')->paginate("6");
        return view('welcome')->with(['cats'=>$cats,'posts'=>$posts]);
    }

    public function getSearchPosts(Request $request){
        $q=$_GET['q'];
        $cats=Category::get();
        $posts=Post::where('item_name',"LIKE","%$q%")
            ->orwhere('price',"LIKE","%$q%")
            ->OrderBy('id','desc')->paginate("6");
        return view('welcome')->with(['cats'=>$cats,'posts'=>$posts]);
    }

    public function getAddtoCart($id){
        $post=Post::whereId($id)->firstOrFail();
        $oldPost=Session::has('cart') ? Session::get('cart'):null;
        $cart=new Cart($oldPost);
        $cart->add($post); // add method is come from Cart model
        Session::put('cart',$cart);

        //dd($cart);
        return redirect()->back();
    }

    public function getShoppingCart(){
        return view('shopping-cart');
    }

    public function getIncreaseCartQty($id){
        $post=Post::whereId($id)->firstOrFail();
        $oldcart=Session::get('cart');
        $cart=new Cart($oldcart);
        $cart->increase($post); // increase method is come from Cart model
        Session::put('cart',$cart);
        return redirect()->back();
    }

    public function getDecreaseCartQty($id){
        $oldcart=Session::get('cart');
        $cart=new Cart($oldcart);
        $cart->decrease($id);

        if(count($cart->posts) < 1){
            Session::forget('cart');
        }else{
            Session::put('cart',$cart);
        }

        return redirect()->back();
    }

    public function postCheckout(Request $request){
        $this->validate($request,[
            'phone'=>'required',
            'address'=>'required'
        ]);

        $order=new Order();
        $order->user_id=Auth::id();
        $order->phone=$request['phone'];
        $order->address=$request['address'];
        $order->save();
        $items=Session::get('cart')->posts;
        foreach ($items as $i) {
            $order_item=new Orderitem();
            $order_item->order_id=$order->id;
            $order_item->item_name=$i['post']['item_name'];
            $order_item->price=$i['post']['price'];
            $order_item->qty=$i['qty'];
            $order_item->amount=$i['amount'];
            $order_item->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('info','The order have been checkout.');
    }



}
