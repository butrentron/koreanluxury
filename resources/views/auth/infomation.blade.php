@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin cá nhân</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('site.info.create') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Họ tên</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Số ĐT</label>

                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Địa chỉ</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Tin nhắn</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="message">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="row col-md-12 cart-item">
                            <div class="table-responsive cart_info">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="cart_menu info">
                                            <th class="image" width="80">Sản phẩm</th>
                                            <th width="170"></th>
                                            <th class="">Màu sắc</th>
                                            <th class="">Kích thước</th>
                                            <th class="">Giá tiền</th>
                                            <th class="">Số lượng</th>
                                            <th class="price">Tổng tiền</th>
                                            <th class="text-center">Hủy sản phẩm</th>
                                        </tr>
                                    </thead>
                                    @foreach(Cart::content() as $item)
                                    <tbody>
                                        <tr>
                                            <td class="cart_product">
                                                <img src="{{ $item->options->image }}" class="img-responsive" alt="{{$item->name}}" width="80" />
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="{{ route('site.products', [ $item->id, $item->options->slug ]) }}">{{$item->name}}</a></h4>
                                            </td>
                                            <td class="cart_price text-center">
                                                <p>{{ $item->options->color ? $item->options->color : '-' }}</p>
                                            </td>
                                            <td class="cart_price text-center">
                                                <p>{{ $item->options->size ? $item->options->size : '-' }}</p>
                                            </td>
                                            <td class="cart_price text-center">
                                                <p>{{ number_format($item->price) }} <sup>vnđ</sup></p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    {{ $item->qty }}
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">{{ number_format($item->subtotal) }} <sup>vnđ</sup></p>
                                            </td>
                                            <td class="cart_delete text-center">
                                                <a class="cart_quantity_delete" href="{{ route('site.cart.get', ['product_id' => $item->id, 'remove' => 'true']) }}"><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Đặt hàng
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
