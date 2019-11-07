
@extends('layouts.app');

@section('title') Posts @stop


@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3">
                @include('partials.menu')
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-3">
                        <div><i class="fas fa-tags"></i> Posts</div>
                    </div>
                    <div class="col-sm-3 offset-sm-6">
                        <form method="get" action="{{route('search.post')}}">
                            <input type="search" name="q" class="form-control-plaintext" required placeholder="Search Post">
                        </form>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row table-responsive">
                    <table class="table table-borderless table-hover">
                        <tr class="bg-secondary text-white">
                            <th>ID</th>
                            <th>Images</th>
                            <th><a href="{{route('order.by.itemname')}}" class="text-white">Item Name <i class="fas fa-sort-alpha-down-alt"></i> </a> </th>
                            <th><a href="{{route('order.by.price')}}" class="text-white">Price <i class="fas fa-sort-amount-down-alt"></i></a> </th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Post By</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($posts as $p)
                            <tr class="small">
                                <td>{{ $p->id }}</td>
                                <td class="col-2">
                                    <img class="img-thumbnail" src="{{route('posts.image',['file_name'=>$p->image])}}" style="height: 130px">
                                </td>
                                <td>{{$p->item_name}}</td>
                                <td>$ {{$p->price}}</td>
                                <td>{{Str::limit($p->description,50)}}</td>
                                <td>{{$p->category->cat_name}}</td> <!-- category is come from category method in Post model -->
                                <td>{{$p->user->name}}</td> <!-- user is come from user method in Post model -->
                                <td>{{$p->created_at->diffForHumans()}}</td>
                                <td>
                                 <!-- Example single danger button -->
                                     <div class="btn-group">
                                       <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <i class="fas fa-cogs"></i>
                                       </button>
                                       <div class="dropdown-menu">
                                         <a class="dropdown-item text-secondary"  href="#"><i class="fas fa-eye"></i> View Post</a>
                                           <div class="dropdown-divider"></div>
                                         <a class="dropdown-item text-info " href="{{ route('edit.post',['id'=>$p->id]) }}"><i class="fas fa-edit"></i> Edit </a>
                                           <div class="dropdown-divider"></div>
                                         <a data-toggle="modal" data-target="#d{{$p->id}}" class="dropdown-item text-danger" href="#"><i class="fas fa-times-circle"></i> Drop</a>
                                       </div>
                                     </div>
                                    <!-- Modal for delete -->
                                    <div id="d{{$p->id}}" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-2"></i>
                                                    <p class="text-danger">Are you sure? The item name <b>"{{$p->item_name}}"</b> will be deleted permanently.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('post.drop',['id'=>$p->id])}}">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    {{ $posts->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
    @if(Session('info'))
        <div class="alert alert-success myAlert">
            {{ Session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop
