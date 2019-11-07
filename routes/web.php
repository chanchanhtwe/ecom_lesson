<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'uses'=>'FrontendController@getWelcome',
    'as'=>'/'
]);

Route::get('/post-images/{file_name}',[
   'uses'=>'FrontendController@getImage',
   'as'=>'images'
]);

Route::get('/posts/category/id/{cat_id}',[
    'uses'=>'FrontendController@getPostsByCategory',
    'as'=>'posts.by.category'
]);

Route::get('/search/post',[
    'uses'=>'FrontendController@getSearchPosts',
    'as'=>'search.posts'
]);

Route::get('add/cart/id/{id}',[
    'uses'=>'FrontendController@getAddtoCart',
    'as'=>'add.to.cart'
]);

Route::get('/shopping/cart',[
    'uses'=>'FrontendController@getShoppingCart',
    'as'=>'shopping.cart'
]);

Route::get('/increase/cart/qty/{id}',[
    'uses'=>'FrontendController@getIncreaseCartQty',
    'as'=>'increase.cart'
]);

Route::get('/decrease/cart/qty/{id}',[
   'uses'=>'FrontendController@getDecreaseCartQty',
   'as'=>'decrease.cart'
]);

Auth::routes(['verify' => true]);

Route::group(['prefix'=>'user','middleware'=>'auth'],function (){

    Route::post('/checkout',[
        'uses'=>'FrontendController@postCheckout',
        'as'=>'checkout'
    ]);

    Route::get('/dashboard',[
        "uses"=>'HomeController@index',
        "as"=>'dashboard'
    ]);//->middleware('auth');
});

Route::group(['prefix'=>'posts','middleware'=>'role:Admin'],function (){ //"middleware=>auth" also the same as "role:Admin|Member"
   Route::get('/categories',[
       "uses"=>"PostController@getCategories" ,
        "as"=>"posts.categories"
   ]);
   Route::post('/new/categories',[
       "uses"=>"PostController@postNewCategories",
        "as"=>"new.categories"
   ]);
   Route::get('/delete/categories/id/{id}',[
       "uses"=>'PostController@getDeleteCategories',
       "as"=>'delete.category'
    ]);
   Route::post('/update/category',[
      "uses"=>'PostController@postUpdateCategories',
      "as"=>'update.category'
   ]);
   Route::get('/all',[
       'uses'=>'PostController@getShowPosts',
       'as'=>'posts'
   ]);
   Route::get('/new/post',[
       'uses'=>'PostController@getNewPost',
      'as'=>'new.post'
   ]);
   Route::post('/add/post',[
       'uses'=>'PostController@postNewPost',
       'as'=>'post.add'
   ]);
   Route::get('/post-image/{file_name}',[
       'uses'=>'PostController@getImage',
       'as'=>'posts.image'
   ]);
   Route::get('/drop/post/{id}',[
      'uses'=>'PostController@getDropPost',
      'as'=>'post.drop'
   ]);
   Route::get('/post/id/{id}/edit',[
       'uses'=>'PostController@getEditPost',
       'as'=>'edit.post'
   ]);
   Route::post('/update/post',[
      'uses'=>'PostController@postUpdatePost',
      'as'=>'update.post'
   ]);
   Route::get('/search/posts',[
      'uses'=>'PostController@getSearchPost',
      'as'=>'search.post'
   ]);
    Route::get('/order/item-name',[
        'uses'=>'PostController@getOrderByItem',
        'as'=>'order.by.itemname'
    ]);
    Route::get('/order/price',[
        'uses'=>'PostController@getOrderByPrice',
        'as'=>'order.by.price'
    ]);
   Route::get('/order',[
       'uses'=>'OrderController@getOrder',
       'as'=>'orders'
   ]);
   Route::get('/order/filter/by/date',[
      'uses'=>'OrderController@getOrder',
      'as'=>'filter.by.date'
   ]);
   Route::get('/order/filter/by/month',[
      'uses'=>'OrderController@getOrder',
      'as'=>'filter.by.month'
   ]);
   Route::get('/order/finish/{id}',[
      'uses'=>'OrderController@getOrderFinish',
      'as'=>'order.finish'
   ]);

});

Route::group(['prefix'=>'Admin','middleware'=>'role:Admin'],function (){ // role is come from $routeMiddleware in app/Http/Kernel.php
   Route::get('/users/all',[
       'uses'=>'UserController@getUsers',
       'as'=>'users'
   ]);
   Route::post('/assign/user/role',[
      'uses'=>'UserController@postAssignUserRole',
      'as'=>'assign.user.role'
   ]);
   Route::get('/delete/user/id/{id}',[
      'uses'=>'UserController@getDeleteUser',
      'as'=>'delete.user'
   ]);
   Route::post('update/user',[
      'uses'=>'UserController@postUpdateUser',
      'as'=>'update.user'
   ]);
});

//Route::get('/home', 'HomeController@index')->name('home');
