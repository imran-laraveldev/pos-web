<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.name', 'Laravel') }} :: Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/global/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/pages/css/login3.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/layout/css/themes/default.css') }}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{ asset('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>

<body class="login">
    <div class="logo" style="background-color: #FFFFFF; padding: 5px 30px 5px; width: 360px;text-align:left">
        <img src="{{ asset('assets/admin/layout/img/logo-webserve.png') }}" alt=""/>
    </div>
    <br/>

    <div class="content">
        @yield('content')
    </div>

    <div class="copyright">
        <?php echo date('Y');?> &copy; {{ config('app.name', 'Laravel') }}
    </div>
    
<!--[if lt IE 9]>
<script src="{{ asset('assets/globals/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/globals/plugins/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/globals/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/globals/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/globals/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/globals/plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/login.js') }}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
    });
</script>
</body>
</html>
