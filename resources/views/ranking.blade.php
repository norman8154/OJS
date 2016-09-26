@extends('layouts.master')
@section('title')
    <title>排名</title>
@show
@section('content')
    <div class="bloc bg-pexels-photo-113850-3 b-parallax  bgc-white" id="bloc-2">
        <div class="container bloc-sm">
            <div class="row bgc-outer-space voffset-lg">
                <div class="col-sm-12">
                    <div role="tabpanel">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#total" id="home-tab" role="tab"
                                                                      data-toggle="tab" aria-controls="home"
                                                                      aria-expanded="true">總和</a></li>
                            <script>
                                $('#home-tab').click(function () {
                                    document.getElementById('myTabDrop1').innerHTML = "題目<span class=\"caret\"></span>";
                                });
                            </script>
                            <li role="presentation" class="dropdown">
                                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-controls="myTabDrop1-contents" aria-expanded="false">題目<span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-scrollable" role="menu" aria-labelledby="myTabDrop1"
                                    id="myTabDrop1-contents">
                                    @foreach($topic_count as $topic)
                                        <li><a href="#{{$topic->topic}}" tabindex="-1" role="tab"
                                               id="{{$topic->topic}}-tab" data-toggle="tab"
                                               aria-controls="{{$topic->topic}}">{{$topic->topic}}</a></li>
                                        <script>
                                            $('#<?php echo $topic->topic; ?>-tab').click(function () {
                                                document.getElementById('myTabDrop1').innerHTML = "<?php echo $topic->topic; ?><span class=\"caret\"></span>";
                                            });
                                        </script>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="total" aria-labelledby="home-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="tc-white">#</th>
                                        <th class="tc-white">姓名</th>
                                        <th class="tc-white">AC</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $rank = 1; ?>
                                    @foreach($subject as $s)
                                        @if($rank%2 == 1)
                                            <tr>
                                                <td>{{$rank}}</td>
                                                <td>{{$s->name}}</td>
                                                <td>{{$s->count}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="tc-white">{{$rank}}</td>
                                                <td class="tc-white">{{$s->name}}</td>
                                                <td class="tc-white">{{$s->count}}</td>
                                            </tr>
                                        @endif
                                        <?php $rank++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @foreach($topic_count as $topic_tab)
                                <div role="tabpanel" class="tab-pane fade" id="{{$topic_tab->topic}}"
                                     aria-labelledby="{{$topic_tab->topic}}-tab">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="tc-white">#</th>
                                            <th class="tc-white">姓名</th>
                                            <th class="tc-white">執行時間(ms)</th>
                                            <th class="tc-white">記憶體用量(KB)</th>
                                            <th class="tc-white">上傳時間</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($each_topic[$topic_tab->topic]!=null)
                                            <?php $rank = 1; ?>
                                            @foreach($each_topic[$topic_tab->topic] as $each)
                                                @if($rank%2 == 1)
                                                    <tr>
                                                        <td>{{$rank}}</td>
                                                        <td>{{$each->name}}</td>
                                                        <td>{{$each->time}}</td>
                                                        @if($each->memory == 0)
                                                            <td><1</td>
                                                        @else
                                                            <td>{{$each->memory}}</td>
                                                        @endif
                                                        <td>{{$each->updated_at}}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="tc-white">{{$rank}}</td>
                                                        <td class="tc-white">{{$each->name}}</td>
                                                        <td class="tc-white">{{$each->time}}</td>
                                                        @if($each->memory == 0)
                                                            <td class="tc-white"><1</td>
                                                        @else
                                                            <td class="tc-white">{{$each->memory}}</td>
                                                        @endif
                                                        <td class="tc-white">{{$each->updated_at}}</td>
                                                    </tr>
                                                @endif
                                                <?php $rank++; ?>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection