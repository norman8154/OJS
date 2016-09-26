@extends('admin.layout.master')

@section('title')
    <title>OJS</title>
    @show

    @section('content')
            <!-- bloc-1 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax bgc-white l-bloc" id="bloc-1">
        <div class="container bloc-lg">
            <div class="row">
                <form id="setting-form" method="POST" action="/admin/setting">
                    {!! csrf_field() !!}
                    <div class="col-sm-2">
                        <h4 class="tc-white">允許admin註冊</h4>
                    </div>
                    <div class="col-sm-2">
                        <label class="switch tc-white">
                            @if(strcmp($settings[0]->allow_admin_register, "on") == 0)
                                <input type="checkbox" id="admin_register" name="allow" checked>
                            @else
                                <input type="checkbox" id="admin_register" name="allow">
                            @endif
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                        <span class="input-group-btn">
                            <a href="/admin/setting/adminverify" class="btn btn-success btn-rd"
                               type="button">生成admin通行碼</a>
                        </span>
                            @if(!empty(Session::get('admin_verify')))
                                <input type="text" class="form-control btn-rd" autofocus onfocus="this.select()"
                                       value={{ Session::get('admin_verify') }} >
                            @else
                                <input type="text" class="form-control btn-rd" value="" disabled>
                            @endif
                        </div>
                    </div>
                </form>
                <script>
                    $('#admin_register').click(function () {
                        document.getElementById('setting-form').submit();
                    });
                </script>
            </div>
            <h5>
                <br>
            </h5>
            <div>
                <div class="row">
                    <form method="POST" action="/admin/setting/filedir">
                        {!! csrf_field() !!}
                        <div class="col-sm-2">
                            <h4 class="tc-white">檔案存放目錄</h4>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control btn-rd" value="{{$settings[0]->file_dir}}" placeholder="路徑" name="file_dir">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-rd" type="submit">確定</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection