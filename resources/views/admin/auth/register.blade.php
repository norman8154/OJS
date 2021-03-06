@extends('admin.layout.master')

@section('title')
    <title>註冊</title>
    @show

    @section('content')

            <!-- bloc-4 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax tc-white bgc-white " id="bloc-4">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <form class="form-register" method="POST" action="/admin/register">
                        {!! csrf_field() !!}
                        @if(Session::has('NotFound'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>糟糕!</strong> {{ Session::get('message', '') }}
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>
                                姓名<br>
                            </label>
                            <input type="name" name="name" class="form-control" value="{{ old('name') }}" autofocus placeholder="本名">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>
                                帳號<br>
                            </label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="學校信箱">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>
                                密碼
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="限6~20字">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>
                                確認密碼<br>
                            </label>
                            <input type="password" name="password_confirmation" class="form-control">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('verify') ? ' has-error' : '' }}">
                            <label>
                                通行碼<br>
                            </label>
                            <input type="verify" name="verify" class="form-control">
                            @if ($errors->has('verify'))
                                <span class="help-block">
                                        <strong>請輸入通行碼</strong>
                                    </span>
                            @endif
                        </div>
                        <button class="bloc-button btn btn-lg btn-block btn-rd btn-lapis-lazuli" type="submit">
                            註冊
                        </button>
                    </form>
                </div>
                <div class="col-sm-4">
                    <span class="empty-column"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-4 END -->



@endsection