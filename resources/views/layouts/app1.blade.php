<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
{{--    <meta content="" name="description"/>--}}
{{--    <meta content="" name="author"/>--}}
{{--    <meta name="MobileOptimized" content="320">--}}
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

{{--    <link href="{{ asset('assets/global/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('assets/admin/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/layout'.env('TEMPLATE_SUFFIX','').'/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/layout'.env('TEMPLATE_SUFFIX','').'/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{ asset('assets/admin/layout'.env('TEMPLATE_SUFFIX','').'/css/custom.css') }}" rel="stylesheet" type="text/css"/>

{{--    <link rel="stylesheet" href="{{asset('js/datatable/css/dataTables.bs4.css')}}"/>--}}
{{--    <link rel="stylesheet" href="{{asset('js/datatable/css/dataTables.bs4-custom.css')}}"/>--}}
    <link rel="stylesheet" href="{{asset('assets-cattle/css/buttons.dataTables.min.css')}}"/>
    @stack('style')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content">
@php
    $current_route=\Request::route()->getName();
@endphp
    @include('layouts.layout.header')

    <div class="clearfix"></div>
    <div class="page-container">
        @include('layouts.layout.navigation')
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <h3 class="page-title">
                    {{ $title ?? 'Dashboard' }} <small>blank page</small>
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li><i class="fa fa-home"></i>
                            <a href="{{ route('home') }}"><?php #echo $partent;?></a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('home') }}"><?php #echo $sub_node;?></a>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right" <?php if($current_route == 'Dashboard') echo 'style="display:none;"'?>>
                            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                                Actions <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" onclick="add()">New Record</a></li>
                                <li><a href="#" onclick="edit('{{ $current_route }}?method=edit')" >Update</a></li>
                                <li><a href="#" onclick="del()">Delete</a></li>
                                <li class="divider"></li>
                                <li><a href="#" onclick="submitForm()">Save</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    </div>
    <form id="sign-out" method="post" action="{{ route('logout') }}">
        @csrf
    </form>
    @include('layouts.layout.footer')

    @stack('scripts')
    <script >
        $('.signout-btn').on('click', function (){
            $('#sign-out').submit();
        });

        function verifyCheck(url,msg='') {
            if(msg==""){
                msg="You are about to delete a record. This cannot be undone, are you sure?";
            }
            var x = window.confirm(msg)
            if (x) {
                window.location = url;
            }
        }
    </script>
</body>
</html>
