@extends('admin.layout.master')

@section('title')
    <title>OJS</title>
    @show

    @section('content')
            <!-- bloc-1 -->
    <div class="bloc bg-pexels-photo-113850-3 b-parallax bgc-white l-bloc" id="bloc-1">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <a href="/admin/post/create"
                       class="btn  btn-rd btn-xl btn-block btn-success">新增</a>
                </div>
            </div>
            <h3 class="mg-clear">
                <br>
            </h3>
            @foreach ($subject as $s)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div class="text-center">
                            <a href="/admin/post/{{$s->id}}"
                               class="btn  btn-rd btn-xl btn-block btn-lapis-lazuli">{{$s->topic}}</a>
                        </div>
                    </div>

                    <form id="delete_form" action="/admin/post/{{$s->id}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="col-sm-1">
                            <a href="/admin/post/{{$s->id}}/edit" class="btn btn-sq btn-primary pull-right"
                               role="button">編輯</a>
                            <a class="btn btn-sq btn-danger pull-right" data-toggle="modal"
                               data-target="#deleteTopic{{$s->id}}">刪除</a>
                        </div>

                        <div class="modal fade" id="deleteTopic{{$s->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">刪除 {{$s->topic}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>真的要刪掉嗎 ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">
                                            讓它走
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            留下來
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h3 class="mg-clear">
                    <br>
                </h3>
            @endforeach
        </div>
    </div>
    <!-- bloc-1 END -->


@endsection








