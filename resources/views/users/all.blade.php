
@extends('layouts.app');

@section('title') User Post @stop


@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3">
                @include('partials.menu')
            </div>
            <div class="col-sm-9">
                <div><i class="fas fa-users"></i> All Users </div>
                <div class="dropdown-divider"></div>
                <div class="row table-responsive">
                    <table class="table table-hover table-borderless">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($users as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>

                                    @if($u->hasAnyRole(['Admin','Member']))
                                        {{$u->roles()->first()->name}}
                                        @else
                                            Role not assign.
                                        @endif

                                </td> <!-- restrict name among role -->
                                <td>{{$u->created_at->diffForHumans()}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#r{{$u->id}}" href="#" class="btn btn-outline-info btn-sm">
                                        <span data-toggle="tooltip" data-placement="top" title="Assign User Role">
                                            <i class="fas fa-user-cog"></i>
                                        </span>
                                    </a>
                                    <!-- User role assign modal-->
                                    <div id="r{{$u->id}}" class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <form method="post" action="{{route('assign.user.role')}}">
                                                <input type="hidden" name="user_id" value="{{$u->id}}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Assign role for <b>"{{$u->name}}"</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="role">Select Role</label>
                                                            <select name="role" id="role" class="custom-select">
                                                                @foreach($roles as $r)
                                                                    <option>{{$r->name}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <!--End user role assign modal -->
                                    <a data-toggle="modal" data-target="#e{{$u->id}}" href="#" class="btn btn-outline-primary btn-sm">
                                        <span data-toggle="tooltip" data-placement="top" title="Edit User">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                                    </a>
                                    <!--Modal for edit -->
                                    <div id="e{{$u->id}}" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="{{route('update.user')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $u->id }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">User Name</label>
                                                            <input type="text" id="name" name="name" class="form-control" value="{{ $u->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" id="email" name="email" class="form-control" value="{{ $u->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-primary">Save Change</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal for edit -->
                                    <a data-toggle="modal" data-target="#d{{$u->id}}" href="#" class="btn btn-outline-danger btn-sm">
                                        <span data-toggle="tooltip" data-placement="top" title="Delete User">
                                            <i class="fas fa-user-times"></i>
                                        </span>
                                    </a>
                                    <!-- Modal for delete -->
                                    <div id="d{{$u->id}}" class="modal fade" tabindex="-1" role="dialog">
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
                                                    <p class="text-danger">Are you sure? The user  <b>"{{$u->name}}"</b> will be deleted permanently.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('delete.user',['id'=>$u->id])}}">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal for delete -->
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
