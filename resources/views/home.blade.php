@extends('layouts.app')

@section('title') Dashboard @stop

@section('content')

    @if(Auth::User()->hasAnyRole(['Admin']))

        <div class="container mt-5 py-4">
            <div class="col-sm-2"><i class="fas fa-tachometer-alt"></i> Dashboard</div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card shadow bg-secondary mb-4">
                        <div class="card-body">
                            <span class="text-white"><i class="fas fa-tags"></i> Posts </span>
                            <span class="float-right btn btn-outline-warning rounded-circle text-white">{{count($posts)}}</span>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('posts')}}" class="btn btn-block btn-link text-white">More >></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow bg-danger mb-2">
                        <div class="card-body">
                            <span class="text-white"><i class="fas fa-list-ul"></i> Categories </span>
                            <span class="float-right btn btn-outline-warning rounded-circle text-white">{{count($cats)}}</span>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('posts.categories')}}" class="btn btn-block btn-link text-white">More >></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow bg-success">
                        <div class="card-body">
                            <span class="text-white"><i class="fas fa-first-order-alt"></i> Orders </span>
                            <span class="float-right btn btn-outline-warning rounded-circle text-white">{{count($orders)}}</span>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('orders')}}" class="btn btn-block btn-link text-white">More >></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card shadow bg-info">
                        <div class="card-body">
                            <span class="text-white"><i class="fas fa-users-cog"></i> Users </span>
                            <span class="float-right btn btn-outline-warning rounded-circle text-white">{{count($users)}}</span>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('users')}}" class="btn btn-block btn-link text-white">More >></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    @else

        <div class="container mt-5 py-4">
            <div class="row">
                <div class="col-sm-2"> <i class="fas fa-first-order-alt"></i> My Orders</div>
                <div class="col-sm-4">
                    <form method="get" action="{{route('filter.by.date')}}" id="form_filter_by_date">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Filter By Date</div>
                                </div>
                                <input type="date" id="filter_by_date" class="form-control" name="filter_by_date">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <form method="get" action="{{route('filter.by.month')}}" id="form_filter_by_month">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Filter By Month</div>
                                </div>
                                <select id="filter_by_month" name="filter_by_month" class="form-control">
                                    <option value="">Select Month</option>
                                    <option value="2019-01">Jan 2019</option>
                                    <option value="2019-02">Feb 2019</option>
                                    <option value="2019-03">Mar 2019</option>
                                    <option value="2019-04">Apr 2019</option>
                                    <option value="2019-05">May 2019</option>
                                    <option value="2019-06">Jun 2019</option>
                                    <option value="2019-07">July 2019</option>
                                    <option value="2019-08">Aust 2019</option>
                                    <option value="2019-09">Sept 2019</option>
                                    <option value="2019-10">Oct 2019</option>
                                    <option value="2019-11">Nov 2019</option>
                                    <option value="2019-12">Dec 2019</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="accordion" id="accordionExample">
                @foreach($orders as $od)
                    <div class="card">
                        <div class="card-header @if($od->status) bg-success @else bg-warning @endif" id="h{{$od->id}} ">
                            <h2 class="mb-0">
                                <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#c{{$od->id}}" aria-expanded="true" aria-controls="c{{$od->id}}">
                                    <i class="fas fa-caret-down"></i> Order ID : {{$od->id}}
                                </button>
                            </h2>
                        </div>

                        <div id="c{{$od->id}}" class="collapse show" aria-labelledby="h{{$od->id}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4" style="border-right: 2px solid gray">
                                        <p>{!! DNS2D::getBarcodeHTML($od->id, "QRCODE"); !!}</p>
                                        <!--<p>{!! DNS1D::getBarcodeHTML($od->id, "CODABAR"); !!}</p>-->
                                        <p>
                                            <i class="fas fa-user"></i> Name : <span id="orderInfo">{{$od->user->name}}</span> <!-- user method is come from in Order model-->
                                        </p>
                                        <p>
                                            <i class="fas fa-envelope-open"></i> Email : <span id="orderInfo">{{$od->user->email}}</span>
                                        </p>
                                        <p>
                                            <i class="fas fa-phone"></i> Phone : <span id="orderInfo">{{$od->phone}}</span>
                                        </p>
                                        <p>
                                            <i class="fas fa-map-pin"></i> Address : <span id="orderInfo">{{$od->address}}</span>
                                        </p>
                                        <p>
                                            <i class="fas fa-calendar-day"></i> Date : <span id="orderInfo">{{$od->created_at}}</span>
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-8" >
                                                @if( $od->status==1 )
                                                    <span class="text-success" id="textinfo" name="textinfo">Finished Order</span>
                                                @else
                                                    <span class="text-danger" id="textinfo" name="textinfo">Waiting Order</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <table class="table table-borderless table-hover">
                                            <tr class="bg-secondary">
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Amount</th>
                                            </tr>
                                        <?php $totalAmount=0; ?>
                                        @foreach($od->orderitem as $i) <!-- orderitem method is come from in Order model-->
                                            <?php $totalAmount +=$i->amount ?>
                                            <tr>
                                                <td>{{$i->item_name}}</td>
                                                <td>{{$i->price}}</td>
                                                <td>{{$i->qty}}</td>
                                                <td>{{$i->amount}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="text-right">Total Amount</td>
                                                <td>{{$totalAmount}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endif

@endsection
