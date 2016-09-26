@extends('layouts.master')

@section('title')
    <title>OJS</title>
    @endsection

    @section('content')
            <!-- bloc-1 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax bgc-white l-bloc" id="bloc-1">
        <div class="container bloc-lg">
            <?php $count = 0; ?>
            @foreach ($subject as $s)
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                        <div class="text-center">
                            <a href="/post/{{$s->id}}"
                               class="btn  btn-rd  btn-xl btn-block btn-lapis-lazuli">{{$s->topic}}</a>
                        </div>
                    </div>
                    @if(Auth::check() && strcmp($topic_result[$count], "") != 0)
                            <div class="col-sm-1 col-xs-1">
                                <a class="pull-right btn-x">{{$topic_result[$count]}}</a>
                            </div>
                    @endif
                </div>
                <h3 class="mg-clear">
                    <br>
                </h3>
                <?php $count++; ?>
            @endforeach
        </div>
    </div>
    <!-- bloc-1 END -->


@endsection








