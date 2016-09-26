@extends('layouts.master')

@section('title')
    <title>登入</title>
    @show

    @section('content')

            <!-- bloc-5 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax tc-white bgc-white" id="bloc-5">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <form class="form-signin" method="POST" action="/login">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('studentID') ? ' has-error' : '' }}">
                            <label>
                                帳號<br>
                            </label>
                            <input type="text" name="studentID" class="form-control" autofocus value="{{ old('studentID') }}" placeholder="學號">
                            @if ($errors->has('studentID'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('studentID') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>
                                密碼
                            </label>
                            <input type="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="remember-me">記住我
                            </label>
                        </div>
                        <button class="bloc-button btn btn-lg btn-block btn-rd btn-lapis-lazuli" type="submit">
                            登入
                        </button>
                    </form>
                </div>
                <div class="col-sm-4">
                    <span class="empty-column"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-5 END -->
@endsection