@extends('admin.layout.master')

@section('title')
    <title>{{ $subject->topic }}</title>
    @show

    @section('content')

            <!-- bloc-2 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax bgc-white" id="bloc-2">
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
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-2 END -->
{{--
    <!-- bloc-3 -->
    <div class="bloc b-parallax bg-pexels-photo-113850-3 bgc-white l-bloc" id="bloc-3">
        <div class="container bloc-md">
            <div class="row">
                <form action="/admin/answer" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="topicID" value="{{ $subject->id }}"/>
                    <div class="col-sm-6">
                        <label class="btn btn-rd btn-xl pull-right btn-lapis-lazuli" id="upload"
                               for="upload_button">上傳</label>
                        <input class="pull-right" type="file" id="upload_button" name="uploadfile" required
                               style="opacity:0.0;height:50px;width:0px">
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-rd btn-xl pull-left btn-lapis-lazuli" type="submit">送出</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- bloc-3 END -->
    --}}


@endsection

