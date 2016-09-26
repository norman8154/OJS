@extends('admin.layout.master')
@section('title')
    <title>新增</title>
@show


@section('content')

    <!-- bloc-8 -->
    <div class="bloc tc-white bgc-white bg-pexels-photo-113850-3 d-bloc b-parallax " id="bloc-8">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-addSubject" method="POST" action="/admin/post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>
                                deadline<br>
                            </label>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="y" id="y">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                年
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right dropdown-scrollable" role="menu">
                                                @for($y=2016;$y<=2018;$y++)
                                                    <li><a id="y{{$y}}">{{$y}}</a></li>
                                                    <script>
                                                        $('#y<?php echo $y; ?>').click(function () {
                                                            document.getElementById('y').setAttribute('value', '<?php echo $y; ?>');
                                                        });
                                                    </script>
                                                @endfor
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" name="m" id="m">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                月
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right dropdown-scrollable" role="menu">
                                                @for($m=1;$m<=12;$m++)
                                                    <li><a id="m{{$m}}">{{$m}}</a></li>
                                                    <script>
                                                        $('#m<?php echo $m; ?>').click(function () {
                                                            document.getElementById('m').setAttribute('value', '<?php echo $m; ?>');
                                                        });
                                                    </script>
                                                @endfor
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" name="d" id="d">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                日
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right dropdown-scrollable" role="menu">
                                                @for($d=1;$d<=31;$d++)
                                                    <li><a id="d{{$d}}">{{$d}}</a></li>
                                                    <script>
                                                        $('#d<?php echo $d; ?>').click(function () {
                                                            document.getElementById('d').setAttribute('value', '<?php echo $d; ?>');
                                                        });
                                                    </script>
                                                @endfor
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" name="h" id="h">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                點
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right dropdown-scrollable" role="menu">
                                                @for($h=0;$h<=23;$h++)
                                                    <li><a id="h{{$h}}">{{$h}}</a></li>
                                                    <script>
                                                        $('#h<?php echo $h; ?>').click(function () {
                                                            document.getElementById('h').setAttribute('value', '<?php echo $h; ?>');
                                                        });
                                                    </script>
                                                @endfor
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" name="mm" id="mm">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                分
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right dropdown-scrollable" role="menu">
                                                @for($mm=0;$mm<=59;$mm++)
                                                    <li><a id="mm{{$mm}}">{{$mm}}</a></li>
                                                    <script>
                                                        $('#mm<?php echo $mm; ?>').click(function () {
                                                            document.getElementById('mm').setAttribute('value', '<?php echo $mm; ?>');
                                                        });
                                                    </script>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                題目<br>
                            </label><textarea name="topic" class="form-control" rows="1" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                內容
                            </label><textarea name="detail" class="form-control" rows="10" cols="50"
                                              required></textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                測資<br>
                            </label><textarea name="input" class="form-control" rows="10" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                結果
                            </label><textarea name="output" class="form-control" rows="10" cols="50"
                                              required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="btn btn-rd btn-xl pull-right btn-lapis-lazuli" id="upload"
                                       for="upload_input">附加</label>
                                <input class="pull-right" type="file" id="upload_input" name="uploadfile" required
                                       style="opacity:0.0;height:50px;width:0px">
                            </div>
                            <div class="col-sm-6">
                                <div class="text-center">
                                    <button class="btn pull-left btn-lapis-lazuli btn-rd btn-xl " type="submit">送出</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-8 END -->
@endsection