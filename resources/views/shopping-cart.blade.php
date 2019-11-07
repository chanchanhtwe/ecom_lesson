@extends('layouts.app')

@section('title') Shopping Cart @stop

@section('content')

    <div class="container mt-5 py-4">
        <div>
            <i class="fas fa-shopping-cart"></i> Shopping Cart
        </div>
        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-hover table-borderless">
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                    @if(Session::has('cart'))
                        @foreach(Session::get('cart')->posts as $item) <!-- posts id in getAddtoCart method from FrontendController -->
                            <tr>
                                <td>{{$item['post']['item_name']}}</td>
                                <td>{{$item['post']['price']}}</td>
                                <td>
                                    <a href="{{route('decrease.cart',['id'=>$item['post']['id']])}}" class="btn btn-outline-info btn-sm"><i class="fas fa-minus-circle"></i> </a>
                                    <span class="btn btn-outline-warning rounded-circle">{{$item['qty']}}</span>
                                    <a href="{{route('increase.cart',['id'=>$item['post']['id']])}}" class="btn btn-outline-info btn-sm"><i class="fas fa-plus-circle"></i> </a>
                                </td>
                                <td>{{$item['amount']}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Total Qty</td>
                                <td>{{ Session::get('cart')->totalQty }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Total Amount</td>
                                <td>{{ Session::get('cart')->totalAmount }}</td>
                            </tr>
                        @else
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-danger"> Empty item Cart</div>
                            </td>
                        </tr>
                        @endif
                </table>
                <a href="{{route('/')}}"><i class="fas fa-shopping-basket"></i> Continue Shopping</a>
            </div>
            <div class="col-sm-4">
                @if(Auth::User())
                    @if((Session::has('cart')) && (Auth::User()->hasAnyRole(['Admin','Member'])))
                        <p class="text text-danger">
                            The field with star is all require to fill.
                        </p>
                        <form method="post" action="{{route('checkout')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="tel" id="phone" name="phone" class="form-control @if($errors->has('phone')) is-invalid @endif">
                                @if($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Address *</label>
                                <textarea id="address" name="address" class="form-control @if($errors->has('address')) is-invalid @endif"></textarea>
                                @if($errors->has('address'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Checkout</button>
                            </div>
                        </form>
                        @else
                        <p>
                            Please contact to Web site administrator<br>
                            <a href="tel::09450758906"><i class="fas fa-phone-alt"></i> Call Now</a>
                        </p>
                        @endif
                    @endif

            </div>
        </div>
    </div>

    @stop