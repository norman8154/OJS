<!DOCTYPE html>
<html lang="en">
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
                    <a class="navbar-brand" href="/admin"><img src="/img/logo.png" alt="logo" draggable="true"
                                                               ondragend="toAdmin(event)"/>OJS admin</a>
                    <button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                                class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <script>
                    function toAdmin(event) {
                        window.location.href = "/";
                    }
                </script>
                <div class="navbar-collapse navbar-1 collapse">
                    <ul class="site-navigation nav navbar-nav">
                        <li>
                            <a href="/admin/post">題目</a>
                        </li>
                        {{--<li>
                            <a href="/admin/post/create">新增</a>
                        </li>--}}
                        <li>
                            <a href="/ranking">排行</a>
                        </li>
                        @if (Auth::guest() & !Auth::guard('admin')->check())
                            <li><a href="{{ url('/admin/register') }}">註冊</a></li>
                            <li><a href="{{ url('/admin/login') }}">登入</a></li>
                        @else
                            <li>
                                <a href="admin/setting">設定</a>
                            </li>
                            {{--<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">--}}
                            <li>
                                <a href="{{ url('/admin/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    登出
                                </a>

                                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                {{--</li>
                            </ul>--}}
                            </li>
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
        <div class="container bloc-md">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="mg-md text-center">
                        © 2016 OnlineJudgeSystem design by sorosora
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer - bloc-4 END -->
    @show
</div>
<!-- Main container END -->




