<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getCategories(){
        $cats=Category::get();
        return view('post.categories')->with(['cats'=>$cats]);
    }

    public function postNewCategories(Request $request){
        $this->validate($request,['cat_name'=>'required|unique:categories']);

        $c=new Category();
        $cat_name=$request['cat_name'];
        $c->cat_name=$cat_name;
        $c->save();

        return redirect()->back()->with('info','The new category has been saved');
    }

    public function getDeleteCategories($id){
        //$c=Category::where('id',$id)->firstOrFail();//first();
        $c=Category::whereId($id)->firstOrFail();//first();
        $c->delete();
        return redirect()->back()->with('info','The selected category has been deleted');
    }

    public function postUpdateCategories(Request $request){
        $cat_id=$request['cat_id'];
        $c=Category::whereId($cat_id)->firstOrFail();
        $c->cat_name=$request['cat_name'];
        $c->update();

        return redirect()->back()->with('info','The selected category has been updated.');
    }

    public function getSearchPost(Request $request){
        $q=$request['q'];
        $posts=Post::where('item_name',"LIKE","%$q%")
            ->orWhere('price',"LIKE","%$q%")
            ->paginate(4);
        return view('post.posts')->with(['posts'=>$posts]);
    }

    public function getShowPosts(){
        $posts=Post::OrderBy('id','desc')->paginate(4);
        return view('post.posts')->with(['posts'=>$posts]);
    }

    public function getNewPost(){
        $c=Category::get();
        return view('post.new-post')->with(['cats'=>$c]);

    }

    public function getOrderByItem(){
        $posts=Post::OrderBy('item_name','desc')->paginate("4");
        return view('post.posts')->with(['posts'=>$posts]);
    }

    public function getOrderByPrice(){
        $posts=Post::OrderBy('price','desc')->paginate("4");
        return view('post.posts')->with(['posts'=>$posts]);
    }

    public function postNewPost(Request $request){
        $this->validate($request,[
            'item_name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png,gif',
            'price'=>'required',
            'description'=>'required'
        ]);

        $img_name=$request['item_name']."-".date("dymhis").".".$request->file('image')->getClientOriginalExtension();//getClientOriginalName();
        $img_file=$request->file('image');

        $p=new Post();
        $p->item_name=$request['item_name'];
        $p->price=$request['price'];
        $p->image=$img_name;
        $p->description=$request['description'];
        $p->category_id=$request['category'];
        $p->user_id=Auth::User()->id; //Auth::id();
        $p->save();

        Storage::disk('posts')->put($img_name,File::get($img_file));

        return redirect()->back()->with('info','The new post has been created.');
    }
    public function getImage($file_name){
        $file=Storage::disk('posts')->get($file_name);
        return response($file)->header('Content-type',"*.*");
    }

    public function getDropPost($id){
        $post=Post::whereId($id)->firstOrFail();
        Storage::disk('posts')->delete($post->image);
        $post->delete();

        return redirect()->back()->with('info','The selected post has been deleted permanently.');
    }

    public function getEditPost($id){
        $cats=Category::get();
        $posts=Post::whereId($id)->firstOrFail();
        return view('post.edit-post')->with(['cats'=>$cats,'posts'=>$posts]);
    }

    public function postUpdatePost(Request $request){
        $id=$request['id'];
        $post=Post::whereId($id)->firstOrFail();
        $image=$request->file('image');
        if($image){
            Storage::disk('posts')->delete($post->image); // delete old image in posts folder in storage folder
            $img_name=$request['item_name']."-".date("dmyhis").".".$request->file('image')->getClientOriginalExtension();
            $img=$request->file('image');
            Storage::disk('posts')->put($img_name,File::get($img)); //insert image into posts folder in storage

            $post->image=$img_name;
        }

        $post->item_name=$request['item_name'];
        $post->price=$request['price'];
        $post->description=$request['description'];
        $post->category_id=$request['category'];
        $post->update();

        return redirect()->route('posts')->with('info','The selected post have been updated.');
    }

}
