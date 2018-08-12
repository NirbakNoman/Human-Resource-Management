<!DOCTYPE>
<html>
<head>
    <title>Byte Lab HRM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fonts/google-fonts-2.css') }}">

    <style>
        .footer {
            padding: 20px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
        }
    </style>

    @yield('additionalCSS')

</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Byte Lab HRM</a>
        </div>
        <ul class="nav navbar-nav">

            <li>
                <a href="{{route('employeeList')}}"><i class="fa fa-binoculars" aria-hidden="true"></i> <span>Employee List</span></a>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Job Details SetUp<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('departmentList')}}">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i><span> Department</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('jobTitleList')}}">
                            <i class="fa fa-list" aria-hidden="true"></i><span> Job Title </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Qualification SetUp<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('skillList')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i><span> Skill </span></a></li>
                    <li><a href="{{route('educationList')}}"><i class="fa fa-list" aria-hidden="true"></i><span> Education Level </span></a></li>
                    <li><a href="{{route('languageList')}}"><i class="fa fa-list" aria-hidden="true"></i><span> Language </span></a></li>
                    {{-- <li><a href="{{route('userCategoryList')}}"><i class="fa fa-list" aria-hidden="true"></i><span>@lang('User Category List') </span></a></li>--}}
                </ul>
            </li>

        </ul>
    </div>
</nav>

<div class="wrapper">
    <div style="margin-bottom: 100px">
        @yield('sidebar')
        @yield('content')
    </div>

    <footer class="footer">
        <strong>Copyright &copy; 2018 <a href="#">BYTELAB  LIMITED</a> </strong> All rights reserved.
    </footer>
</div>




<script src="{{ asset('js/jquery.min.js')  }}" type="text/javascript" charset="utf-8"></script>
<script src={{ asset('js/bootstrap.min.js')}} type="text/javascript"></script>

@yield('additionalJS')
</body>

</html>