@extends('layouts.app')

@section('title') Welcome @stop

@section('content')

    @include('partials.slide')

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-sm-3">
                <div class="card shadow mb-2">
                    <div class="card-header">Cart</div>
                    <div class="card-body">
                        <p><a href="{{route('shopping.cart')}}">
                                <span class="badge badge-success">
                                    <i class="fas fa-shopping-basket"></i>&nbsp;
                                    {{ Session::has('cart')? Session::get('cart')->totalQty : "0" }}
                                </span> Items
                            </a>
                        </p>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                       <!-- {{ Session::has('cart') ? Session::get('cart')->totalQty : "" }} -->
                        <form method="get" action="{{route('search.posts')}}">
                            <div class="form-group">
                                <input type="search" name="q" class="form-control" required>
                            </div>
                            </form>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header"><i class="fas fa-list-ul"></i> Categories</div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            @foreach($cats as $c)
                            <tr class="small">
                               <td class="d-block">
                                   <a href="{{route('posts.by.category',['cat_id'=>$c->id])}}" class="d-block"> {{$c->cat_name}}</a>
                               </td>
                            </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    @foreach($posts as $p)
                        <div class="col-sm-4">
                            <div class="card shadow" style="width: 18rem;">
                                <img src="{{route('images',['file_name'=>$p->image])}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$p->item_name}}</h5>
                                    <p class="card-text">
                                        <span class="badge badge-secondary">$ {{$p->price}}</span>
                                    </p>
                                    <p class="card-text">
                                        <small><i class="fas fa-tag"></i> {{$p->category->cat_name}} </small>
                                        &nbsp;
                                        <small><i class="fas fa-user-tag"> </i> {{$p->user->name}}</small>
                                        &nbsp;
                                        <small><i class="fas fa-calendar-day"></i> {{date("D(d) m/Y",strtotime($p->created_at))}}</small>
                                    </p>
                                    <a href="{{ route('add.to.cart',['id'=>$p->id]) }}" class="btn btn-outline-primary btn-block"><i class="fas fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
               {{$posts->links()}}
            </div>
        </div>
    </div>

    <div class="card bg-secondary mt-5">
        <div class="card-body">
            <p class="text text-center text-white-50">&copy; 2019 my..co.ltd</p>
            <div class="dropdown-divider"></div>
            @foreach($cats as $c)
                <a href="{{route('posts.by.category',['cat_id'=>$c->id])}}" class="text-white-50">{{$c->cat_name}}</a> &nbsp;
                @endforeach
        </div>
    </div>

    @stop