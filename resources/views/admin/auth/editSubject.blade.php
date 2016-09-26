@extends('admin.layout.master')

@section('title')
    <title>編輯</title>
    @show

@section('content')


    <!-- bloc-8 -->
    <div class="bloc tc-white bgc-white bg-pexels-photo-113850-3 d-bloc b-parallax " id="bloc-8">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-addSubject" method="POST" action="/admin/post/{{ $subject->id }}">
                        <input name="_method" type="hidden" value="PUT">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>
                                題目<br>
                            </label><textarea name="topic"  class="form-control" rows="1" cols="50" required>{{ $subject->topic }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                內容
                            </label><textarea name="detail"  class="form-control" rows="10" cols="50" required>{{ $subject->detail }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                測資<br>
                            </label><textarea name="input"  class="form-control" rows="10" cols="50" required>{{ $subject->input }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                結果
                            </label><textarea name="output"  class="form-control" rows="10" cols="50" required>{{ $subject->output }}</textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn   btn-lapis-lazuli btn-rd btn-xl " type="submit">送出</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-8 END -->

@endsection