<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Practicas Pre-Profesionales</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('layouts.navbar')

@include('layouts.sidebar')




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('layouts.contentTitle')
        <!-- Main content -->
        <div class="content">
            <div class="card">

                <div class="card-body">

                    @yield('content')

                </div>

            </div>
        </div>
    <!-- /.content-wrapper -->
    </div>
    @include('layouts.sidebar2')


    @include('layouts.footer')
</div>
<script src="{{mix('js/vendor.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>