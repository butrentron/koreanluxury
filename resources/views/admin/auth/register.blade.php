@extends('admin.layouts.app')
@section('auth.form')
<div class="tab-pane fade in active" id="register">
    <h3 class="no-margin-top"><i class="fontello-icon-users"></i>Thêm một tài khoản</h3>
    <form class="form-tied margin-00" method="post" action="{{ route('admin.post.register') }}" name="login_form">
        <input type="hidden" name="_url" value="{{ Request::get('url') }}">
        <input type="hidden" name="_method" value="POST">
        {!! csrf_field() !!}
        <fieldset>
            <legend class="two"><span>Thông tin tài khoản</span></legend>
            <ul>
                <li>
                    <input id="namereg" class="input-block-level" type="text" name="name" placeholder="Nhập họ tên" value="{{ old('name') }}"/>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </li>
                <li>
                    <input id="emailreg" class="input-block-level" type="text" name="email" placeholder="Nhập địa chỉ email" value="{{ old('email') }}"/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </li>
            </ul>
        </fieldset>
        <fieldset>
            <legend class="two"><span>Password</span></legend>
            <ul>
                <li>
                    <input id="passwordreg" class="input-block-level" type="password" name="password" placeholder="Mật khẩu" />
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </li>
                <li>
                    <input id="passwordconfirmreg" class="input-block-level" type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" />
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </li>
            </ul>
            <button type="submit" class="btn btn-green btn-block btn-large">Đăng kí</button>
        </fieldset>
    </form>
</div>
@stop