@extends('layouts.master')

@section('title')
    <title>驗證</title>
    @show

    @section('content')

            <!-- bloc-5 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax tc-white bgc-white" id="bloc-5">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <form action="/verify" method="POST">
                        {!! csrf_field() !!}
                        @if(Session::has('NotFound'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <strong>糟糕!</strong> {{ Session::get('message', '') }}
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('verify') ? ' has-error' : '' }}">
                            <label>
                                驗證碼<br>
                            </label>
                            <input type="text" name="verify" class="form-control" autofocus placeholder="請至信箱領取" value="{{ old('verify') }}">
                            @if ($errors->has('studentID'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('verify') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <a href="/resend" class="pull-right">
                            <strong>重新傳送</strong>
                        </a>
                        <label class="pull-right">沒收到嗎？</label>
                        <button class="bloc-button btn btn-lg btn-block btn-rd btn-lapis-lazuli" type="submit">
                            確認
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
