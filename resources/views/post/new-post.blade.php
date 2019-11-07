
@extends('layouts.app');

@section('title') Add New Post @stop


@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3">
                @include('partials.menu')
            </div>
            <div class="col-sm-9">
                <div><i class="fas fa-plus-square"></i> New Post </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-sm-8">
                        <form enctype="multipart/form-data" method="post" action="{{route('post.add')}}">
                            @csrf
                            <div class="form-group">
                                <label for="image">Image</label> <!-- Before upload image, config foleder/filesystems.php/local copy next one  -->
                                <input type="file" id="image" name="image" style="height: 130px"  class="form-control-file @if($errors->has('image')) is-invalid @endif">
                                @if($errors->has('image'))
                                    <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="item_name">Item Name</label>
                                <input type="text" id="item_name" name="item_name" class="form-control @if($errors->has('item_name')) is-invalid @endif">
                                @if($errors->has('item_name'))
                                        <span class="invalid-feedback">{{ $errors->first('item_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" id="price" name="price" class="form-control @if($errors->has('price')) is-invalid @endif">
                                @if($errors->has('price'))
                                        <span class="invalid-feedback">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="descriptio n" name="description" class="form-control @if($errors->has('description')) is-invalid @endif"></textarea>
                                @if($errors->has('description'))
                                        <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="custom-select @if($errors->has('category')) is-invalid @endif">
                                    @foreach($cats as $c)
                                        <option value="{{$c->id}}">{{$c->cat_name}}</option>
                                        @endforeach
                                </select>
                                @if($errors->has('category'))
                                    <span class="invalid-feedback">{{ $errors->first('category') }}</span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Save</button>
                            </div>
                            @csrf
                        </form>
                    </div>
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
