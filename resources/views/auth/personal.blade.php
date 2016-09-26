@extends('layouts.master')
@section('title')
    <title>個人頁面</title>
    @show
    @section('content')
            <!-- bloc-6 -->
    <div class="bloc bgc-white bg-pexels-photo-113850-3 d-bloc b-parallax " id="bloc-6">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: {{$ac_rate}}%">
                            {{$ac_rate}}%
                        </div>
                        {{--<div class="progress-bar progress-bar-warning" style="width: 20%">
                            20%
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: 10%">
                            10%
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-6 END -->
@endsection