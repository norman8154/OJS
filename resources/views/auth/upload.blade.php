@extends('layouts.master')

@section('title')
    <title>{{ $subject->topic }}</title>
    @show

    @section('content')

            <!-- bloc-2 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax  bgc-white" id="bloc-2">
        <div class="container bloc-sm">
            <div class="row bgc-outer-space voffset-lg">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="text-left mg-md tc-white">
                                <?php
                                $text = str_replace(' ', '&nbsp', $subject->topic);
                                echo nl2br($text); ?>
                            </h3>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="text-left mg-md tc-white pull-right">
                                Deadline: {{$subject->deadline}}
                            </h5>
                        </div>
                    </div>


                    <h4 class="mg-md text-left tc-white">
                        <?php
                        $text = str_replace(' ', '&nbsp', $subject->detail);
                        echo nl2br($text); ?>
                    </h4>
                    @if (strcmp($subject->file, 'null'))
                    <form action="/post/attachment" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="topicID" value="{{ $subject->id }}"/>
                        <span class="tc-white">附件：</span>
                        <a class="btn" type="submit">{{$subject->file}}</a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        {{--</div>--}}
                <!-- bloc-2 END -->

        <!-- bloc-3 -->
        {{--<div class="bloc b-parallax bg-pexels-photo-113850-3 bgc-white l-bloc" id="bloc-3">--}}
        <div class="container bloc-md">
            <div class="row">
                <form action="/answer" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="topicID" value="{{ $subject->id }}"/>
                    @if (Auth::guest())
                        <div class="col-sm-6 col-xs-6">
                            <label class="btn btn-rd btn-xl pull-right btn-lapis-lazuli" id="upload" data-toggle="modal"
                                   data-target="#check_alert">上傳</label>
                            <div id="check_alert" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            請先登入
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/login" type="button" class="btn btn-primary">登入</a>
                                            <button class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <button class="btn btn-rd btn-xl pull-left btn-lapis-lazuli" type="submit" disabled>送出
                            </button>
                        </div>
                    @else
                        <div class="col-sm-6 col-xs-6">
                            <label class="btn btn-rd btn-xl pull-right btn-lapis-lazuli" id="upload"
                                   for="upload_input">上傳</label>
                            <input class="pull-right" type="file" id="upload_input" name="uploadfile" required
                                   style="opacity:0.0;height:50px;width:0px">
                            <script>
                                var inputFile = document.getElementById('upload_input');
                                inputFile.onchange = function () {
                                    if (this.value == '') {

                                    } else {
                                        document.getElementById("submit_button").disabled = false;
                                    }
                                }
                            </script>

                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <button id="submit_button" class="btn btn-rd btn-xl pull-left btn-lapis-lazuli"
                                    type="submit" disabled>送出
                            </button>
                        </div>
                    @endif
                </form>

                @if(!empty(Session::get('answer')))
                    <script>
                        $(function () {
                            $('#answer').modal('show');
                        });
                    </script>
                @endif

                <div class="modal fade" id="answer" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">結果</h4>
                            </div>
                            <div class="modal-body">
                                <p>{{ Session::get('answer') }}</p>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" data-dismiss="modal">
                                    好的
                                </a>
                                <a type="button" href="/ranking" class="btn btn-success">
                                    排名
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-3 END -->


@endsection

