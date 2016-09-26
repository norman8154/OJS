<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>

    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" href="/css/animate.css"/>
    <link rel='stylesheet' href='/css/font-awesome.min.css'/>
    {{--<link href="http://fonts.googleapis.com/earlyaccess/notosanstc.css?family=Noto+Sans+TC" rel="stylesheet">--}}
    {{--<link href="http://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet">--}}


    <script src="/js/jquery-2.1.0.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/blocs.js"></script>

    @section('title')

    @show


            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Main container -->
<div class="page-container">

    @section('header')

            <!-- bloc-0 -->
    <div class="bloc b-parallax bgc-outer-space d-bloc sticky-nav " id="bloc-0">
        <div class="container">
            <nav class="navbar row">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="logo" draggable="true"
                                                          ondragend="toAdmin(event)"/>OJS</a>
                    <button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                                class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <script>
                    function toAdmin(event) {
                        window.location.href = "/admin";
                    }
                </script>
                <div class="navbar-collapse navbar-1 collapse">

                    <ul class="site-navigation nav navbar-nav nav-pills">

                        <li>
                            <a href="/post">題目</a>
                        </li>
                        <li>
                            <a href="/ranking">排行</a>
                        </li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/register') }}">註冊</a></li>
                            <li><a href="{{ url('/login') }}">登入</a></li>
                        @else

                            {{--<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/personal">個人</a>
                                    </li>--}}
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    登出
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @if($online_count != null)
                                <li role="presentation" class="active"><a>上線人數<span class="badge">{{$online_count}}</span></a></li>
                            @endif

                        {{--</ul>
                    </li>--}}
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- bloc-0 END -->

    @show

    @section('content')

    @show

    @section('footer')
            <!-- Footer - bloc-4 -->
    <div class="bloc bgc-outer-space d-bloc" id="bloc-4">
        {{--<div class="container ">--}}
        <div class="row">
            <div class="col-sm-12">
                <a href="http://moodle.ntust.edu.tw" class="mg-md btn-block d-bloc text-center">問題回報</a>
            </div>

        </div>
        {{--</div>--}}
        <div class="bloc-md">
            <div class="col-sm-12">
                <h5 class="text-center">
                    © 2016 NTUST CSIE OnlineJudgeSystem
                </h5>
            </div>
        </div>
    </div>
    <!-- Footer - bloc-4 END -->
    @show
</div>
<!-- Main container END -->




